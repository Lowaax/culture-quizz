import { Route, Routes } from 'react-router-dom';
import Home from './pages/Home';
import CategorySelect from './pages/CategorySelect';
import Quiz from './pages/Quiz';
import Results from './pages/Results';
import Compte from './pages/Compte';

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/categories" element={<CategorySelect />} />
      <Route path="/quiz/:categorieId" element={<Quiz />} />
      <Route path="/resultats" element={<Results />} />
      <Route path="/compte" element={<Compte />} />
    </Routes>
  );
}
