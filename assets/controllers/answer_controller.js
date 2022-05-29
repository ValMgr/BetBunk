const collection = Array.from(document.getElementsByClassName("answer"));
var finalCollection = 0;

function accentChars(str)
    {
        return str
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

 const time = document.getElementById('time').innerText.match(/\d+/)[0];
 var count = parseInt(time);

 answerNumber.innerText = collection.length;
 clockSeconds.innerText = count;
 clock.style.display = 'block';
 timeForQuiz.style.display = 'none';
 answerBlock.style.display = 'block';
 buttonStart.style.display = 'none';

 function timer() {
  count = count - 1;
  clockSeconds.innerText = count;

  document.addEventListener('keyup', () => {
  
   findAnswer.innerText = finalCollection;  
  
   collection.forEach(function(element){
    const lowerCaseAnswer = element.innerText.toLowerCase();
    const finalAnswer = accentChars(lowerCaseAnswer)
    

    const lowerCaseResponse = inputAnswer.value.toLowerCase();
    const finalResponse = accentChars(lowerCaseResponse)
    
  
    if (finalResponse == finalAnswer) {
     element.classList.remove("hideAnswer");
     element.classList.remove("wrongAnswer");
     element.classList.add("showAnswer");
     element.classList.add("correctAnswer");
     inputAnswer.value = "";
     finalCollection += 1;
  
    }
   });
  })

  if (count === 0 && finalCollection != collection.length) {
   clearInterval(timerInterval);
   timeBlock.style.display = "none";
   answerBlock.style.display = "none";
   header.style.display = "none";
   finish.style.display = "block";
   collection.forEach(function(element){
    element.classList.remove("hideAnswer");
   });
   
  } else if (finalCollection == collection.length){
   notFinish.style.display = "block";
   answerBlock.style.display = "none";
   header.style.display = "none";
  }
 }

 var timerInterval = setInterval(timer, 1000);

}