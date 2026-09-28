export interface Categorie {
  id: number;
  categorie: string;
  nombreQuestions: number;
  /** Meilleur score enregistré sur cette catégorie, null si jamais jouée. */
  meilleurScore: number | null;
}

/** Une question telle que l'API l'envoie : sans la bonne réponse. */
export interface QuizQuestion {
  id: number;
  question: string;
  reponses: string[];
}

export interface QuizResponse {
  categorie: string;
  questions: QuizQuestion[];
}

/** Réponse du serveur après vérification du choix du joueur. */
export interface VerificationResponse {
  correct: boolean;
  bonneReponse: string;
}

export interface PartieResponse {
  partie: {
    id: number;
    user_id: number | null;
    categorie_id: number;
    score: number;
    total: number;
  };
  meilleurScore: number | null;
  /** Renseigné uniquement si la partie a été jouée en étant connecté. */
  meilleurScorePersonnel: number | null;
}

export interface Utilisateur {
  id: number;
  name: string;
  email: string;
}

export interface AuthResponse {
  utilisateur: Utilisateur;
  token: string;
}

export interface PartieJouee {
  id: number;
  categorie: string | null;
  score: number;
  total: number;
  jouee_le: string;
}

export interface MesParties {
  parties: PartieJouee[];
  records: Array<{
    categorie_id: number;
    meilleur_score: number;
    parties_jouees: number;
  }>;
}
