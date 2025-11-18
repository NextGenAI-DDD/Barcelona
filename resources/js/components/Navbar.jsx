import React, { useMemo } from 'react';

const BRAND = {
  homeUrl: '/',
  desktopLogo: '/storage/img/herb.png',
  mobileLogo: '/storage/img/herb.png',
};

const NAV_LINKS = [
  { href: '/', label: 'Main Page' },
  { href: '/players', label: 'Players' },
  {
    dropdown: true,
    label: 'League',
    matchPath: '/laLiga',
    items: [
      { href: '/laLiga/table', label: 'La Liga Table' },
      { href: '/laLiga/games', label: 'Games' },
      { href: '/laLiga/topScores', label: 'Top Scores' },
      { href: '/laLiga/topAssistants', label: 'Top Assistants' },
    ],
  },
  { href: '/contact', label: 'Contact Information' },
];

const classNames = (...classes) => classes.filter(Boolean).join(' ');

const trimTrailingSlash = (path) => {
  if (!path) {
    return '/';
  }

  if (path.length > 1 && path.endsWith('/')) {
    return path.replace(/\/+$/, '') || '/';
  }

  return path;
};

const normalizeHref = (href) => {
  try {
    const url = new URL(href, window.location.origin);
    return trimTrailingSlash(url.pathname);
  } catch (error) {
    return trimTrailingSlash(href);
  }
};

const markActiveLinks = (links, currentPath) =>
  links.map((link) => {
    if (link.dropdown) {
      const shouldBeActive = link.matchPath ? currentPath.startsWith(link.matchPath) : false;
      return {
        ...link,
        active: shouldBeActive,
        items: link.items || [],
      };
    }

    return {
      ...link,
      active: normalizeHref(link.href) === currentPath,
    };
  });

const Navbar = () => {
  const currentPath =
    typeof window !== 'undefined' ? trimTrailingSlash(window.location.pathname) : NAV_LINKS[0].href;

  const links = useMemo(() => {
    return markActiveLinks(NAV_LINKS, currentPath);
  }, [currentPath]);

  return (
    <nav className="navbar navbar-expand-lg bg-white navbar-dark shadow p-0 bg-navbar">
      <a href={BRAND.homeUrl} className="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img className="d-none d-sm-block" src={BRAND.desktopLogo} style={{ width: '100px' }} alt="logo" />
        <img
          className="d-md-none"
          src={BRAND.mobileLogo}
          style={{ width: '100px', marginLeft: '-20px' }}
          alt="logo mobile"
        />
      </a>
      <button
        className="navbar-toggler me-1"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span className="navbar-toggler-icon" />
      </button>
      <div className="collapse navbar-collapse" id="navbarCollapse">
        <div className="navbar-nav ms-auto p-4 p-lg-0">
          {links.map((link) => {
            if (link.dropdown) {
              return (
                <div className="nav-item dropdown" key={link.label}>
                  <a href="#" className={classNames('nav-link dropdown-toggle', link.active && 'active')} data-bs-toggle="dropdown">
                    {link.label}
                  </a>
                  <div className="dropdown-menu fade-up m-0">
                    {(link.items || []).map((item) => (
                      <a key={item.href} href={item.href} className="dropdown-item">
                        {item.label}
                      </a>
                    ))}
                  </div>
                </div>
              );
            }

            return (
              <a key={link.href} href={link.href} className={classNames('nav-item nav-link', link.active && 'active')}>
                {link.label}
              </a>
            );
          })}
        </div>
      </div>
    </nav>
  );
};

export default Navbar;



