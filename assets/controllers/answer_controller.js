
const answersElements = Array.from(document.getElementsByClassName("answer"));
let answers = answersElements.map(a => sanitizeString(a.innerHTML));
let finalCollection = 0;

function sanitizeString(str){
    return str
        .toLowerCase()
        .replace(/[àáâãäå]/g,"a")
        .replace(/[éèêë]/g,"e")
        .replace(/[ùüû]/g,"u")
        .replace(/[^a-z0-9]/gi,'');
}

export function answerFunction() {

 const timeForQuiz = document.getElementById('time');
 const timeBlock = document.getElementById('timeBlock');
 const clock = document.getElementById('timer');
 const clockSeconds = document.getElementById('timerSeconds');
 const answerBlock = document.getElementById('answerBlock');
 const buttonStart = document.getElementById('buttonStart');
 const answerNumber = document.getElementById('answerNumber');

 const header = document.getElementById('header');
 const notFinish = document.getElementById('notFinish');
 const finish = document.getElementById('finish');

 const inputAnswer = document.getElementById('answer');
 const findAnswer = document.getElementById('findAnswer');

 const buttonStop = document.getElementById('buttonStop');

 const time = document.getElementById('time').innerText.match(/\d+/)[0];
 let count = parseInt(time);

 answerNumber.innerText = answers.length;
 clockSeconds.innerText = count;
 clock.style.display = 'block';
 timeForQuiz.style.display = 'none';
 answerBlock.style.display = 'block';
 buttonStart.style.display = 'none';

 const timerInterval = setInterval(timer, 1000);

 buttonStop.addEventListener('click', () => {count = 0;});

 function timer() {
  clockSeconds.innerText = count;

  document.addEventListener('keyup', () => {
    const input = sanitizeString(inputAnswer.value);
    if(answers.includes(input)) {
      finalCollection++;
      inputAnswer.value = '';
      const element = answersElements[answers.indexOf(input)];
      answers = answers.filter(a => a !== input);
      element.classList.remove('hideAnswer');
      element.classList.remove('wrongAnswer');
      findAnswer.innerText = finalCollection;  
    }
  });

  if (count === 0 && finalCollection != answers.length) {
   clearInterval(timerInterval);
   timeBlock.style.display = "none";
   answerBlock.style.display = "none";
   header.style.display = "none";
   finish.style.display = "block";
   answersElements.forEach((e) => {
    e.classList.remove("hideAnswer");
   });
   
  } else if (finalCollection == answers.length){
   notFinish.style.display = "block";
   answerBlock.style.display = "none";
   header.style.display = "none";
  }
  
  count -= 1;
 }


}