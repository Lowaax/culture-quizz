import { useCallback, useEffect, useMemo, useState } from 'react';
import type { ReactNode } from 'react';
import {
  connexion as apiConnexion,
  deconnexion as apiDeconnexion,
  ecrireJeton,
  inscription as apiInscription,
  lireJeton,
  utilisateurCourant,
} from '../api/client';
import type { Utilisateur } from '../api/types';
import { ContexteAuth } from './contexte';

/**
 * Le compte est facultatif : tant que `utilisateur` vaut null, le jeu
 * fonctionne normalement et les parties sont simplement anonymes.
 */
export function AuthProvider({ children }: { children: ReactNode }) {
  const [utilisateur, setUtilisateur] = useState<Utilisateur | null>(null);
  // Sans jeton mémorisé, il n'y a rien à vérifier : on démarre directement
  // en visiteur, sans écran de chargement.
  const [chargement, setChargement] = useState(() => lireJeton() !== null);

  // Un jeton mémorisé est revalidé auprès du serveur : il a pu être révoqué
  // entre deux visites.
  useEffect(() => {
    if (!lireJeton()) return;

    utilisateurCourant()
      .then(setUtilisateur)
      .catch(() => ecrireJeton(null))
      .finally(() => setChargement(false));
  }, []);

  const seConnecter = useCallback(async (email: string, motDePasse: string) => {
    const reponse = await apiConnexion(email, motDePasse);
    ecrireJeton(reponse.token);
    setUtilisateur(reponse.utilisateur);
  }, []);

  const sInscrire = useCallback(
    async (nom: string, email: string, motDePasse: string, confirmation: string) => {
      const reponse = await apiInscription(nom, email, motDePasse, confirmation);
      ecrireJeton(reponse.token);
      setUtilisateur(reponse.utilisateur);
    },
    [],
  );

  const seDeconnecter = useCallback(async () => {
    try {
      await apiDeconnexion();
    } catch {
      // Jeton déjà expiré côté serveur : on nettoie quand même côté navigateur.
    }
    ecrireJeton(null);
    setUtilisateur(null);
  }, []);

  const valeur = useMemo(
    () => ({ utilisateur, chargement, seConnecter, sInscrire, seDeconnecter }),
    [utilisateur, chargement, seConnecter, sInscrire, seDeconnecter],
  );

  return <ContexteAuth.Provider value={valeur}>{children}</ContexteAuth.Provider>;
}
