# Asset Performance

Use for CSS/JS/font/loading work.

Rules:
- load global assets only when globally required
- load component assets only when used
- use filemtime/versioning in development
- prefer defer for UI scripts
- avoid render-blocking third-party assets
- local WOFF2 fonts
- do not lazy-load LCP image
- responsive images
- minimize DOM
- never blindly dequeue Woo/plugin dependencies
