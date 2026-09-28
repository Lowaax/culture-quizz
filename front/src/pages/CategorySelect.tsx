import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { fetchCategories } from '../api/client';
import type { Categorie } from '../api/types';
import Logo from '../components/Logo';
import './CategorySelect.css';

export default function CategorySelect() {
  const navigate = useNavigate();
  const [categories, setCategories] = useState<Categorie[]>([]);
  const [status, setStatus] = useState<'loading' | 'ready' | 'error'>('loading');

  useEffect(() => {
    fetchCategories()
      .then((data) => {
        setCategories(data);
        setStatus('ready');
      })
      .catch(() => setStatus('error'));
  }, []);

  function selectCategory(categorie: Categorie) {
    navigate(`/quiz/${categorie.id}`, { state: { categorieName: categorie.categorie } });
  }

  return (
    <div className="screen category-select">
      <Logo size="sm" />
      <div className="category-heading">
        <span className="eyebrow">Choisissez votre domaine</span>
        <h1>Une catégorie</h1>
      </div>

      {status === 'loading' && <p className="text-dim">Chargement des catégories…</p>}
      {status === 'error' && (
        <p className="text-dim">
          Impossible de contacter l'API. Vérifiez que le serveur Laravel tourne bien.
        </p>
      )}

      {status === 'ready' && (
        <div className="category-grid">
          {categories.map((categorie) => (
            <button
              key={categorie.id}
              className="category-card"
              onClick={() => selectCategory(categorie)}
            >
              <span className="category-card-name">{categorie.categorie}</span>
              <span className="category-card-meta">
                {categorie.nombreQuestions} questions
                {categorie.meilleurScore !== null && ` · record ${categorie.meilleurScore}/10`}
              </span>
            </button>
          ))}
        </div>
      )}
    </div>
  );
}
