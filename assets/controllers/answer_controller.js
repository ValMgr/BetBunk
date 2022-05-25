export function checkAnswerFunction() {
 const inputAnswer = document.getElementById('answer');
 const findAnswer = document.getElementById('findAnswer');

 const collection = Array.from(document.getElementsByClassName("answer"));
 const finalCollection = Array.from(document.getElementsByClassName("correctAnswer"));
 console.log(collection.length)
 console.log(finalCollection.length)
 findAnswer.innerText = finalCollection.length;  

 collection.forEach(function(element){
  const lowerCaseAnswer = element.innerText.toLowerCase();
  const lowerCaseResponse = inputAnswer.value.toLowerCase();

  if (lowerCaseResponse == lowerCaseAnswer) {
   element.classList.remove("hideAnswer");
   element.classList.add("showAnswer");
   element.classList.add("correctAnswer");
   inputAnswer.value = "";

  } else { }
 });

}
