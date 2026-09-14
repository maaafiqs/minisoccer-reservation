<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logo-grad-bg" x1="10" y1="10" x2="90" y2="90" gradientUnits="userSpaceOnUse">
            <stop stop-color="#10B981" />
            <stop offset="1" stop-color="#047857" />
        </linearGradient>
        <linearGradient id="logo-grad-accent" x1="20" y1="20" x2="80" y2="80" gradientUnits="userSpaceOnUse">
            <stop stop-color="#34D399" />
            <stop offset="1" stop-color="#10B981" />
        </linearGradient>
        <filter id="logo-glow" x="0" y="0" width="100" height="100" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feGaussianBlur stdDeviation="3" result="blur" />
            <feComposite in="SourceGraphic" in2="blur" operator="over" />
        </filter>
    </defs>
    <!-- Outer Shield Crest -->
    <path d="M50 8L86 22V50C86 70.5 70.8 89.2 50 94C29.2 89.2 14 70.5 14 50V22L50 8Z" fill="url(#logo-grad-bg)" stroke="#34D399" stroke-width="2" />
    <path d="M50 14L80 25.5V50C80 67.5 67.2 83.2 50 87.5C32.8 83.2 20 67.5 20 50V25.5L50 14Z" fill="#064E3B" opacity="0.4" />
    
    <!-- Soccer Ball Elements -->
    <circle cx="50" cy="48" r="22" fill="#FFFFFF" />
    <!-- Ball Center Pentagon -->
    <polygon points="50,38 58,44 55,54 45,54 42,44" fill="#064E3B" />
    <!-- Ball Seams -->
    <line x1="50" y1="38" x2="50" y2="27" stroke="#064E3B" stroke-width="2.5" stroke-linecap="round" />
    <line x1="58" y1="44" x2="68" y2="39" stroke="#064E3B" stroke-width="2.5" stroke-linecap="round" />
    <line x1="55" y1="54" x2="63" y2="64" stroke="#064E3B" stroke-width="2.5" stroke-linecap="round" />
    <line x1="45" y1="54" x2="37" y2="64" stroke="#064E3B" stroke-width="2.5" stroke-linecap="round" />
    <line x1="42" y1="44" x2="32" y2="39" stroke="#064E3B" stroke-width="2.5" stroke-linecap="round" />
    
    <!-- Star Accents -->
    <polygon points="50,75 52,80 57,80 53,83 55,88 50,85 45,88 47,83 43,80 48,80" fill="#FDE047" />
</svg>

