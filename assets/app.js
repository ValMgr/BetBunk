/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

function docReady(fn){
    if (document.readyState === "complete" || document.readyState === "interactive"){
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(() => {

    if (localStorage.theme === 'dark' || 
    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }

    const darkModeToggle = document.querySelector('#dark-toggle');
    darkModeToggle.addEventListener('click', toggleDarkMode);

    function toggleDarkMode(){
        const currMode = ('theme' in localStorage) ? localStorage.theme : window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (currMode === 'dark') {
            localStorage.theme = 'light';
            document.documentElement.classList.remove('dark');
        }
        else{
            localStorage.theme = 'dark';
            document.documentElement.classList.add('dark');
        }
    }

});

