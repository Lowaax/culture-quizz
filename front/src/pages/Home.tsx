import { useNavigate } from 'react-router-dom';
import { useAuth } from '../auth/useAuth';
import Logo from '../components/Logo';
import './Home.css';

export default function Home() {
  const navigate = useNavigate();
  const { utilisateur } = useAuth();

  return (
    <div className="screen home">
      <div className="home-content">
        <Logo />
        <p className="home-tagline text-dim">
          Que la Force soit avec vous. Testez vos connaissances sur la saga Star Wars.
        </p>
      </div>

      <div className="home-bas">
        <button className="btn btn-primary home-cta" onClick={() => navigate('/categories')}>
          Commencer
        </button>
        <button className="lien-discret" onClick={() => navigate('/compte')}>
          {utilisateur ? `Connecté : ${utilisateur.name}` : 'Se connecter pour garder ses scores'}
        </button>
      </div>
    </div>
  );
}
