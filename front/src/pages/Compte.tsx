import { useEffect, useState } from 'react';
import type { FormEvent } from 'react';
import { useNavigate } from 'react-router-dom';
import { ApiError, fetchMesParties } from '../api/client';
import type { MesParties } from '../api/types';
import { useAuth } from '../auth/useAuth';
import Logo from '../components/Logo';
import './Compte.css';

type Mode = 'connexion' | 'inscription';

export default function Compte() {
  const navigate = useNavigate();
  const { utilisateur, chargement, seConnecter, sInscrire, seDeconnecter } = useAuth();

  const [mode, setMode] = useState<Mode>('connexion');
  const [nom, setNom] = useState('');
  const [email, setEmail] = useState('');
  const [motDePasse, setMotDePasse] = useState('');
  const [confirmation, setConfirmation] = useState('');
  const [erreur, setErreur] = useState<string | null>(null);
  const [envoi, setEnvoi] = useState(false);
  // L'historique est rangé avec l'identifiant de son propriétaire : après un
  // changement de compte, celui du précédent n'est jamais réaffiché.
  const [historique, setHistorique] = useState<{
    userId: number;
    donnees: MesParties;
  } | null>(null);

  useEffect(() => {
    if (!utilisateur) return;

    fetchMesParties()
      .then((donnees) => setHistorique({ userId: utilisateur.id, donnees }))
      .catch(() => undefined);
  }, [utilisateur]);

  async function soumettre(evenement: FormEvent) {
    evenement.preventDefault();
    setErreur(null);
    setEnvoi(true);
    try {
      if (mode === 'connexion') {
        await seConnecter(email, motDePasse);
      } else {
        await sInscrire(nom, email, motDePasse, confirmation);
      }
      setMotDePasse('');
      setConfirmation('');
    } catch (cause) {
      setErreur(
        cause instanceof ApiError
          ? cause.premierDetail
          : 'Impossible de contacter le serveur.',
      );
    } finally {
      setEnvoi(false);
    }
  }

  if (chargement) {
    return (
      <div className="screen compte">
        <p className="text-dim">Chargement…</p>
      </div>
    );
  }

  if (utilisateur) {
    const parties =
      historique && historique.userId === utilisateur.id ? historique.donnees.parties : [];

    return (
      <div className="screen compte">
        <Logo size="sm" />

        <div className="compte-entete">
          <span className="eyebrow">Votre compte</span>
          <h1>{utilisateur.name}</h1>
          <p className="text-dim">{utilisateur.email}</p>
        </div>

        <div className="card compte-historique">
          <span className="eyebrow">Dernières parties</span>
          {parties.length > 0 ? (
            <ul className="historique-liste">
              {parties.map((partie) => (
                <li key={partie.id}>
                  <span>{partie.categorie ?? 'Catégorie supprimée'}</span>
                  <strong>
                    {partie.score}/{partie.total}
                  </strong>
                </li>
              ))}
            </ul>
          ) : (
            <p className="text-dim">
              Aucune partie enregistrée pour l'instant. Vos scores apparaîtront ici.
            </p>
          )}
        </div>

        <div className="compte-actions">
          <button className="btn btn-primary" onClick={() => navigate('/categories')}>
            Jouer
          </button>
          <button className="btn" onClick={() => void seDeconnecter()}>
            Se déconnecter
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="screen compte">
      <Logo size="sm" />

      <div className="compte-entete">
        <span className="eyebrow">Facultatif</span>
        <h1>Garder vos scores</h1>
        <p className="text-dim compte-intro">
          Le quiz se joue sans compte. En créer un permet simplement de retrouver vos
          parties et vos records.
        </p>
      </div>

      <div className="onglets" role="tablist">
        <button
          role="tab"
          aria-selected={mode === 'connexion'}
          className={mode === 'connexion' ? 'onglet onglet--actif' : 'onglet'}
          onClick={() => { setMode('connexion'); setErreur(null); }}
        >
          Connexion
        </button>
        <button
          role="tab"
          aria-selected={mode === 'inscription'}
          className={mode === 'inscription' ? 'onglet onglet--actif' : 'onglet'}
          onClick={() => { setMode('inscription'); setErreur(null); }}
        >
          Inscription
        </button>
      </div>

      <form className="card formulaire" onSubmit={soumettre}>
        {mode === 'inscription' && (
          <label className="champ">
            <span>Pseudo</span>
            <input
              type="text"
              value={nom}
              onChange={(e) => setNom(e.target.value)}
              required
              autoComplete="nickname"
            />
          </label>
        )}

        <label className="champ">
          <span>Adresse email</span>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            autoComplete="email"
          />
        </label>

        <label className="champ">
          <span>Mot de passe</span>
          <input
            type="password"
            value={motDePasse}
            onChange={(e) => setMotDePasse(e.target.value)}
            required
            minLength={8}
            autoComplete={mode === 'connexion' ? 'current-password' : 'new-password'}
          />
        </label>

        {mode === 'inscription' && (
          <label className="champ">
            <span>Confirmer le mot de passe</span>
            <input
              type="password"
              value={confirmation}
              onChange={(e) => setConfirmation(e.target.value)}
              required
              minLength={8}
              autoComplete="new-password"
            />
          </label>
        )}

        {erreur && (
          <p className="erreur-api" role="alert">
            {erreur}
          </p>
        )}

        <button type="submit" className="btn btn-primary" disabled={envoi}>
          {mode === 'connexion' ? 'Se connecter' : 'Créer mon compte'}
        </button>
      </form>

      <button className="lien-discret" onClick={() => navigate('/categories')}>
        Jouer sans compte
      </button>
    </div>
  );
}
