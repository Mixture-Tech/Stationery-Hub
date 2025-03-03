// This code should be placed in your resources/js/home/header.js file
document.addEventListener('DOMContentLoaded', function() {
    const menuGroup = document.querySelector('.group');
    const overlay = document.getElementById('menu-overlay');
    
    // Show overlay when hovering over the menu
    menuGroup.addEventListener('mouseenter', function() {
      overlay.classList.remove('hidden');
    });
    
    // Hide overlay when leaving the menu
    menuGroup.addEventListener('mouseleave', function() {
      overlay.classList.add('hidden');
    });
  });