import type {
  AuthResponse,
  Categorie,
  MesParties,
  PartieResponse,
  QuizResponse,
  Utilisateur,
  VerificationResponse,
} from './types';

const API_URL = import.meta.env.VITE_API_URL ?? 'http://127.0.0.1:8000/api';
const CLE_JETON = 'culture-quiz-token';

/** Erreur d'API, qui transporte le détail de validation renvoyé par Laravel. */
export class ApiError extends Error {
  readonly status: number;
  readonly erreurs: Record<string, string[]>;

  constructor(message: string, status: number, erreurs: Record<string, string[]> = {}) {
    super(message);
    this.name = 'ApiError';
    this.status = status;
    this.erreurs = erreurs;
  }

  /** Premier message de validation, prêt à afficher sous un formulaire. */
  get premierDetail(): string {
    const premier = Object.values(this.erreurs)[0];
    return premier?.[0] ?? this.message;
  }
}

// Le navigateur peut refuser localStorage (mode privé, cookies bloqués) :
// dans ce cas le jeu reste jouable, simplement sans rester connecté.
export function lireJeton(): string | null {
  try {
    return localStorage.getItem(CLE_JETON);
  } catch {
    return null;
  }
}

export function ecrireJeton(jeton: string | null): void {
  try {
    if (jeton) {
      localStorage.setItem(CLE_JETON, jeton);
    } else {
      localStorage.removeItem(CLE_JETON);
    }
  } catch {
    /* stockage indisponible, on continue sans mémoriser la session */
  }
}

async function request<T>(path: string, init: RequestInit = {}): Promise<T> {
  const jeton = lireJeton();

  const response = await fetch(`${API_URL}${path}`, {
    ...init,
    headers: {
      Accept: 'application/json',
      ...(init.body ? { 'Content-Type': 'application/json' } : {}),
      ...(jeton ? { Authorization: `Bearer ${jeton}` } : {}),
      ...init.headers,
    },
  });

  if (!response.ok) {
    const donnees = await response.json().catch(() => null);

    // Jeton expiré ou révoqué : inutile de le garder.
    if (response.status === 401) {
      ecrireJeton(null);
    }

    throw new ApiError(
      donnees?.message ?? `Erreur API (${response.status}) sur ${path}`,
      response.status,
      donnees?.errors ?? {},
    );
  }

  return response.json() as Promise<T>;
}

function post<T>(path: string, body?: unknown): Promise<T> {
  return request<T>(path, {
    method: 'POST',
    body: JSON.stringify(body ?? {}),
  });
}

/* ------------------------------------------------------------------ */
/* Le jeu : accessible sans compte                                     */
/* ------------------------------------------------------------------ */

export function fetchCategories(): Promise<Categorie[]> {
  return request<Categorie[]>('/categories');
}

export function fetchQuiz(categorieId: number): Promise<QuizResponse> {
  return request<QuizResponse>(`/categories/${categorieId}/questions`);
}

/**
 * Le serveur seul connaît la bonne réponse : on lui soumet le choix du joueur
 * (ou null si le temps est écoulé) et il renvoie le verdict.
 */
export function verifierReponse(
  questionId: number,
  reponse: string | null,
): Promise<VerificationResponse> {
  return post<VerificationResponse>(`/questions/${questionId}/verifier`, { reponse });
}

/**
 * La partie est rattachée au compte si un jeton est présent, anonyme sinon.
 */
export function enregistrerPartie(
  categorieId: number,
  score: number,
  total: number,
): Promise<PartieResponse> {
  return post<PartieResponse>('/parties', {
    categorie_id: categorieId,
    score,
    total,
  });
}

/* ------------------------------------------------------------------ */
/* Les comptes : facultatifs, pour conserver ses scores                */
/* ------------------------------------------------------------------ */

export function inscription(
  name: string,
  email: string,
  password: string,
  password_confirmation: string,
): Promise<AuthResponse> {
  return post<AuthResponse>('/register', { name, email, password, password_confirmation });
}

export function connexion(email: string, password: string): Promise<AuthResponse> {
  return post<AuthResponse>('/login', { email, password });
}

export function deconnexion(): Promise<{ message: string }> {
  return post<{ message: string }>('/logout');
}

export function utilisateurCourant(): Promise<Utilisateur> {
  return request<Utilisateur>('/user');
}

export function fetchMesParties(): Promise<MesParties> {
  return request<MesParties>('/mes-parties');
}
