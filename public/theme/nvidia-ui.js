(function(){
  'use strict';
  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('[data-nv-theme-toggle]').forEach(function(btn){
      btn.addEventListener('click', function(){
        document.documentElement.classList.toggle('nv-soft-focus');
      });
    });
  });
})();
