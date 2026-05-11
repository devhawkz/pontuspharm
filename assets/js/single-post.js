(function () {
  'use strict';

  var root = document.querySelector('[data-single-post-author]');

  if (!root) {
    return;
  }

  var btn = root.querySelector('.single-post-author__toggle');
  var panel = root.querySelector('.single-post-author__panel');

  if (!btn || !panel) {
    return;
  }

  function setOpen(open) {
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    panel.hidden = !open;
    root.classList.toggle('is-open', open);
  }

  btn.addEventListener('click', function (e) {
    e.stopPropagation();
    setOpen(panel.hidden);
  });

  panel.addEventListener('click', function (e) {
    e.stopPropagation();
  });

  document.addEventListener('click', function () {
    setOpen(false);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      setOpen(false);
    }
  });
})();
