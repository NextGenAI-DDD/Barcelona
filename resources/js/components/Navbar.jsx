import React, { useMemo } from 'react';
import { useTranslation } from 'react-i18next';

const BRAND = {
  homeUrl: '/',
  desktopLogo: '/storage/img/herb.png',
  mobileLogo: '/storage/img/herb.png',
};

const NAV_LINKS = [
  { href: '/', labelKey: 'navbar.mainPage' },
  { href: '/players', labelKey: 'navbar.players' },
  {
    dropdown: true,
    labelKey: 'navbar.league',
    matchPath: '/laLiga',
    items: [
      { href: '/laLiga/table', labelKey: 'navbar.laLigaTable' },
      { href: '/laLiga/games', labelKey: 'navbar.games' },
      { href: '/laLiga/topScores', labelKey: 'navbar.topScores' },
      { href: '/laLiga/topAssistants', labelKey: 'navbar.topAssistants' },
    ],
  },
  { href: '/contact', labelKey: 'navbar.contact' },
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
  const { t } = useTranslation();
  const currentPath =
    typeof window !== 'undefined' ? trimTrailingSlash(window.location.pathname) : NAV_LINKS[0].href;

  const normalizedLinks = useMemo(() => markActiveLinks(NAV_LINKS, currentPath), [currentPath]);

  const links = useMemo(
    () =>
      normalizedLinks.map((link) => ({
        ...link,
        label: t(link.labelKey),
        items: (link.items || []).map((item) => ({
          ...item,
          label: t(item.labelKey),
        })),
      })),
    [normalizedLinks, t]
  );

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
                <div className="nav-item dropdown" key={link.labelKey}>
                  <a href="#" className={classNames('nav-link dropdown-toggle', link.active && 'active')} data-bs-toggle="dropdown">
                    {link.label}
                  </a>
                  <div className="dropdown-menu fade-up m-0">
                    {(link.items || []).map((item) => (
                      <a key={item.labelKey} href={item.href} className="dropdown-item">
                        {item.label}
                      </a>
                    ))}
                  </div>
                </div>
              );
            }

            return (
              <a key={link.labelKey} href={link.href} className={classNames('nav-item nav-link', link.active && 'active')}>
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



