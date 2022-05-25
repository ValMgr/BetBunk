export function timerFunction() {

 const timeForQuiz = document.getElementById('time');
 const timeBlock = document.getElementById('timeBlock');
 const endQuiz = document.getElementById('endQuiz');
 const clock = document.getElementById('timer');
 const clockSeconds = document.getElementById('timerSeconds');
 const answerBlock = document.getElementById('answerBlock');
 const buttonStart = document.getElementById('buttonStart');
 const answerNumber = document.getElementById('answerNumber');

 const collection = Array.from(document.getElementsByClassName("answer"));
 // const finalCollection = Array.from(document.getElementsByClassName("correctAnswer"));
 // console.log(collection.length)
 // console.log(finalCollection.length)


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
  // if (count === 0 || finalCollection.length == collection.length) {
  if (count === 0) {
   clearInterval(timerInterval);
   timeBlock.style.display = "none"
   endQuiz.style.display = "block"
   console.log('Fini');
  } else {
   console.log(count);
  }
 }

 var timerInterval = setInterval(timer, 1000);



}

