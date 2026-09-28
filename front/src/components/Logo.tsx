import './Logo.css';

interface LogoProps {
  size?: 'sm' | 'lg';
}

export default function Logo({ size = 'lg' }: LogoProps) {
  return (
    <div className={`logo logo--${size}`}>
      <svg viewBox="0 0 64 64" className="logo-icon" aria-hidden="true">
        <circle cx="32" cy="32" r="30" stroke="currentColor" strokeWidth="2" fill="none" opacity="0.35" />
        <line x1="10" y1="32" x2="54" y2="32" stroke="currentColor" strokeWidth="3" strokeLinecap="round" />
        <line x1="32" y1="10" x2="32" y2="54" stroke="currentColor" strokeWidth="3" strokeLinecap="round" opacity="0.55" />
        <circle cx="32" cy="32" r="5" fill="currentColor" />
      </svg>
      <span className="logo-word">
        CULTURE<span className="logo-word-accent">QUIZ</span>
      </span>
    </div>
  );
}
