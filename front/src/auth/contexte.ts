import { createContext } from 'react';
import type { Utilisateur } from '../api/types';

export interface ValeurAuth {
  utilisateur: Utilisateur | null;
  chargement: boolean;
  seConnecter: (email: string, motDePasse: string) => Promise<void>;
  sInscrire: (
    nom: string,
    email: string,
    motDePasse: string,
    confirmation: string,
  ) => Promise<void>;
  seDeconnecter: () => Promise<void>;
}

export const ContexteAuth = createContext<ValeurAuth | null>(null);
