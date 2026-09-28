import { useEffect, useRef, useState } from 'react';
import { useLocation, useNavigate, useParams } from 'react-router-dom';
import { fetchQuiz, verifierReponse } from '../api/client';
import type { QuizQuestion } from '../api/types';
import './Quiz.css';

const QUESTION_DURATION = 30;
const REVEAL_DELAY_MS = 1200;

interface LocationState {
  categorieName?: string;
}

export default function Quiz() {
  const { categorieId } = useParams<{ categorieId: string }>();
  const location = useLocation();
  const navigate = useNavigate();
  const categorieName = (location.state as LocationState | null)?.categorieName;

  const [questions, setQuestions] = useState<QuizQuestion[]>([]);
  const [status, setStatus] = useState<'loading' | 'ready' | 'error'>('loading');
  const [currentIndex, setCurrentIndex] = useState(0);
  const [score, setScore] = useState(0);
  const [selected, setSelected] = useState<string | null>(null);
  const [bonneReponse, setBonneReponse] = useState<string | null>(null);
  const [revealed, setRevealed] = useState(false);
  const [timeLeft, setTimeLeft] = useState(QUESTION_DURATION);

  const current: QuizQuestion | undefined = questions[currentIndex];

  // Le verdict arrive du serveur : tant qu'il est en route, les boutons sont
  // encore actifs à l'écran. Sans ce verrou, deux clics rapides compteraient
  // deux points pour une seule question.
  const verificationEnCours = useRef(false);

  /**
   * Soumet le choix du joueur, ou null si les 30 secondes sont écoulées.
   * C'est le serveur qui tranche : le navigateur n'a jamais reçu la bonne
   * réponse, il ne l'apprend qu'ici, une fois le choix verrouillé.
   */
  async function soumettre(reponse: string | null) {
    if (!current || revealed || verificationEnCours.current) return;
    verificationEnCours.current = true;
    setSelected(reponse);
    try {
      const verdict = await verifierReponse(current.id, reponse);
      if (verdict.correct) {
        setScore((s) => s + 1);
      }
      setBonneReponse(verdict.bonneReponse);
    } catch {
      // API injoignable : on enchaîne sans colorer plutôt que de bloquer le quiz.
      setBonneReponse(null);
    } finally {
      setRevealed(true);
    }
  }

  // Le minuteur doit pouvoir soumettre une absence de réponse sans dépendre de
  // l'identité de `soumettre`, qui change à chaque rendu.
  const soumettreRef = useRef(soumettre);
  useEffect(() => {
    soumettreRef.current = soumettre;
  });

  useEffect(() => {
    if (!categorieId) return;
    fetchQuiz(Number(categorieId))
      .then((data) => {
        setQuestions(data.questions);
        setStatus('ready');
      })
      .catch(() => setStatus('error'));
  }, [categorieId]);

  // Compte à rebours de la question en cours.
  useEffect(() => {
    if (status !== 'ready' || revealed) return;
    if (timeLeft <= 0) {
      void soumettreRef.current(null);
      return;
    }
    const id = setTimeout(() => setTimeLeft((t) => t - 1), 1000);
    return () => clearTimeout(id);
  }, [timeLeft, revealed, status]);

  // Une fois la correction affichée, on enchaîne sur la question suivante ou
  // sur les résultats. La remise à zéro se fait ici, au moment du changement.
  useEffect(() => {
    if (!revealed) return;
    const id = setTimeout(() => {
      if (currentIndex + 1 >= questions.length) {
        navigate('/resultats', {
          state: { score, total: questions.length, categorieName, categorieId },
        });
        return;
      }
      setCurrentIndex((i) => i + 1);
      setSelected(null);
      setBonneReponse(null);
      setRevealed(false);
      setTimeLeft(QUESTION_DURATION);
      verificationEnCours.current = false;
    }, REVEAL_DELAY_MS);
    return () => clearTimeout(id);
  }, [revealed, currentIndex, questions.length, score, categorieName, categorieId, navigate]);

  if (status === 'loading') {
    return (
      <div className="screen quiz">
        <p className="text-dim">Chargement des questions…</p>
      </div>
    );
  }

  if (status === 'error' || !current) {
    return (
      <div className="screen quiz">
        <p className="text-dim">Impossible de charger ce quiz. Réessayez plus tard.</p>
        <button className="btn" onClick={() => navigate('/categories')}>
          Retour aux catégories
        </button>
      </div>
    );
  }

  function answerClass(reponse: string) {
    if (!revealed) return 'answer';
    if (bonneReponse !== null && reponse === bonneReponse) return 'answer answer--correct';
    if (reponse === selected) return 'answer answer--wrong';
    return 'answer answer--dim';
  }

  const verdict = revealed && bonneReponse !== null
    ? selected === bonneReponse
      ? 'Bonne réponse !'
      : `Mauvaise réponse. La bonne réponse était : ${bonneReponse}.`
    : '';

  return (
    <div className="screen quiz">
      <div className="quiz-header">
        <div className="quiz-progress">
          <span className="eyebrow">
            {categorieName ?? 'Quiz'} · {currentIndex + 1}/{questions.length}
          </span>
          <span className="timer-seconds" aria-hidden="true">
            {timeLeft}s
          </span>
        </div>
        <div
          className="timer-track"
          role="progressbar"
          aria-label="Temps restant pour répondre"
          aria-valuemin={0}
          aria-valuemax={QUESTION_DURATION}
          aria-valuenow={timeLeft}
          aria-valuetext={`${timeLeft} secondes restantes`}
        >
          <div
            className="timer-fill"
            style={{ width: `${(timeLeft / QUESTION_DURATION) * 100}%` }}
          />
        </div>
      </div>

      {/* La clé relance l'animation d'apparition à chaque nouvelle question. */}
      <div className="quiz-body" key={current.id}>
        <h1 className="quiz-question">{current.question}</h1>

        <div className="answer-grid">
          {current.reponses.map((reponse, index) => (
            <button
              key={`${current.id}-${index}`}
              className={answerClass(reponse)}
              onClick={() => void soumettre(reponse)}
              disabled={revealed}
            >
              {reponse}
            </button>
          ))}
        </div>
      </div>

      <p className="visually-hidden" role="status" aria-live="polite">
        {verdict}
      </p>

      <p className="quiz-score text-dim">Score : {score}</p>
    </div>
  );
}
