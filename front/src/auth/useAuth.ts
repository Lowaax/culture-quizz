import { useContext } from 'react';
import { ContexteAuth } from './contexte';
import type { ValeurAuth } from './contexte';

export function useAuth(): ValeurAuth {
  const contexte = useContext(ContexteAuth);
  if (!contexte) {
    throw new Error("useAuth doit être utilisé à l'intérieur de AuthProvider");
  }
  return contexte;
}
