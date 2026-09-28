import { useEffect, useRef, useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { enregistrerPartie } from '../api/client';
import Logo from '../components/Logo';
import './Results.css';

interface ResultsState {
  score: number;
  total: number;
  categorieName?: string;
  categorieId?: string;
}

function rank(ratio: number) {
  if (ratio === 1) return { title: 'Maître Jedi', message: 'La Force est forte en vous. Score parfait.' };
  if (ratio >= 0.7) return { title: 'Chevalier Jedi', message: 'Un score solide, digne du Conseil Jedi.' };
  if (ratio >= 0.4) return { title: 'Padawan', message: 'Encore un peu d\'entraînement et la maîtrise viendra.' };
  return { title: 'Initié', message: 'Le chemin vers la sagesse Jedi ne fait que commencer.' };
}

export default function Results() {
  const location = useLocation();
  const navigate = useNavigate();
  const state = location.state as ResultsState | null;
  const [records, setRecords] = useState<{
    global: number | null;
    personnel: number | null;
  } | null>(null);
  // StrictMode joue les effets deux fois en développement : sans ce garde-fou
  // la même partie serait enregistrée en double.
  const dejaEnregistre = useRef(false);

  useEffect(() => {
    if (!state) navigate('/', { replace: true });
  }, [state, navigate]);

  useEffect(() => {
    if (!state?.categorieId || dejaEnregistre.current) return;
    dejaEnregistre.current = true;
    enregistrerPartie(Number(state.categorieId), state.score, state.total)
      .then((reponse) =>
        setRecords({
          global: reponse.meilleurScore,
          personnel: reponse.meilleurScorePersonnel,
        }),
      )
      .catch(() => setRecords(null));
  }, [state]);

  if (!state) return null;

  const { score, total, categorieName, categorieId } = state;
  const ratio = total > 0 ? score / total : 0;
  const { title, message } = rank(ratio);

  return (
    <div className="screen results">
      <Logo size="sm" />

      <div className="results-card card">
        <span className="eyebrow">{categorieName ?? 'Quiz'} terminé</span>
        <p className="results-score">
          {score}
          <span className="results-score-total">/{total}</span>
        </p>
        <h2 className="results-rank">{title}</h2>
        <p className="text-dim results-message">{message}</p>
        {records?.global != null && (
          <p className="results-best text-dim">
            Meilleur score sur cette catégorie : {records.global}/{total}
            {records.personnel != null && (
              <>
                <br />
                Votre record : {records.personnel}/{total}
              </>
            )}
          </p>
        )}
      </div>

      <div className="results-actions">
        {categorieId && (
          <button
            className="btn btn-primary"
            onClick={() =>
              navigate(`/quiz/${categorieId}`, { state: { categorieName }, replace: true })
            }
          >
            Rejouer
          </button>
        )}
        <button className="btn" onClick={() => navigate('/categories')}>
          Autre catégorie
        </button>
      </div>
    </div>
  );
}
