
var quizID = []                                                               // tentatively stores retrieve quiz data in array form
var quizQuestion = []
var quizAnswer1 = []
var quizAnswer2 = []

var quizTracker = 0                                                           // keeps track of the current quiz handled by the user
var quizNumber = 1
var userInput = ''                                                            // stores the quiz answer provided by the user

quizID = document.querySelectorAll('span#quiz_id')                            // retrieve quiz data from hidden DOM elements
quizQuestion = document.querySelectorAll('span#quiz_question')
quizAnswer1 = document.querySelectorAll('span#quiz_answer1')
quizAnswer2 = document.querySelectorAll('span#quiz_answer2')

var quizMaxQuestion = quizID.length                                           // keeps track on the maximum number of quizzes

document.getElementById('userClickAnswer').addEventListener('click', evaluateAnswer)

displayQuestion()

function displayQuestion () {                                                 // displays the quiz question on screen / web page
  if (quizTracker < quizMaxQuestion) {
    var parentQuestionTitle = document.querySelector('span#questionTitle')
    var displayQuestionTitleHere = document.querySelector('h2#questionTitleHere')
    displayQuestionTitleHere.parentNode.removeChild(displayQuestionTitleHere)
    displayQuestionTitleHere = document.createElement('h2')
    displayQuestionTitleHere.classList.add('question')
    displayQuestionTitleHere.setAttribute('id', 'questionTitleHere')
    displayQuestionTitleHere.innerHTML = 'Question ' + quizNumber + ':'
    parentQuestionTitle.appendChild(displayQuestionTitleHere)

    var parentQuestionElement = document.querySelector('div#displayQuestion')
    var displayQuestion = document.createElement('span')
    displayQuestion.classList.add('question')
    displayQuestion.setAttribute('id', 'questionHere')
    displayQuestion.innerHTML = '" ' + quizQuestion[quizTracker].innerText + ' "'
    parentQuestionElement.appendChild(displayQuestion)
  } else {                                                                    // message when the user reaches the end of the quiz
    parentQuestionTitle = document.querySelector('span#questionTitle')
    displayQuestionTitleHere = document.querySelector('h2#questionTitleHere')
    displayQuestionTitleHere.parentNode.removeChild(displayQuestionTitleHere)

    var parentQuestionElementEnd = document.querySelector('div#displayQuestion')
    var displayQuestionEnd = document.createElement('span')
    displayQuestionEnd.classList.add('question')
    displayQuestionEnd.innerHTML = '" End of Quiz. Thank you for using Quiz Master. "'
    parentQuestionElementEnd.appendChild(displayQuestionEnd)

    var targetElementRemove1 = document.querySelector('input#userAnswer')
    targetElementRemove1.parentNode.removeChild(targetElementRemove1)

    var targetElementRemove3 = document.querySelector('button#userClickAnswer')
    targetElementRemove3.parentNode.removeChild(targetElementRemove3)
  }
}

function evaluateAnswer () {                                                  // evaluates the user's answer to the quiz question
  userInput = document.getElementById('userAnswer').value.trim().toLowerCase()
  if ((userInput === quizAnswer1[quizTracker].innerText) || (userInput === quizAnswer2[quizTracker].innerText)) {
    feedbackCorrect()
  } else if (userInput === '') {
    feedbackBlank()
  } else {
    feedbackWrong()
  }
}

function userInputClear () {                                                  // DOM manipulation to clear the user input text box
  var targetUserInput = document.querySelector('input#userAnswer')
  targetUserInput.parentNode.removeChild(targetUserInput)

  var parentClear = document.querySelector('span#userInputHere')
  var inputClear = document.createElement('input')
  inputClear.setAttribute('type', 'text')
  inputClear.setAttribute('id', 'userAnswer')
  inputClear.setAttribute('value', '')
  inputClear.setAttribute('autofocus', '')
  parentClear.appendChild(inputClear)
}

function questionClear () {                                                   // DOM manipulation to clear the previous quiz question
  var targetClear = document.querySelector('span#questionHere')
  targetClear.parentNode.removeChild(targetClear)
}

function feedbackClear () {                                                   // DOM manipulation that clears Quiz Master's feedback
  var targetFeedback = document.querySelector('span#feedBack')
  targetFeedback.parentNode.removeChild(targetFeedback)

  var parentClear = document.querySelector('div#qmFeedback')
  var spanClear = document.createElement('span')
  spanClear.setAttribute('id', 'feedBack')
  spanClear.innerHTML = '&nbsp;'
  parentClear.appendChild(spanClear)
}

function feedbackCorrect () {                                                 // DOM manipulation when the user answers correctly
  var targetFeedback = document.querySelector('span#feedBack')
  targetFeedback.parentNode.removeChild(targetFeedback)

  var parentCorrect = document.querySelector('div#qmFeedback')
  var spanCorrect = document.createElement('span')
  spanCorrect.classList.add('answer-correct')
  spanCorrect.setAttribute('id', 'feedBack')
  spanCorrect.innerHTML = 'Your answer ' + userInput + ' is correct!'
  parentCorrect.appendChild(spanCorrect)
  setTimeout(feedbackClear, 3000)
  setTimeout(questionClear, 2000)
  setTimeout(userInputClear, 1000)
  quizTracker += 1                                                            // Calls up the next quiz question
  quizNumber += 1                                                             // Increments quiz number display
  setTimeout(displayQuestion, 2000)
}

function feedbackBlank () {                                                   // DOM manipulation when the user submits a blank answer
  var targetFeedback = document.querySelector('span#feedBack')
  targetFeedback.parentNode.removeChild(targetFeedback)

  var parentBlank = document.querySelector('div#qmFeedback')
  var spanBlank = document.createElement('span')
  spanBlank.setAttribute('id', 'feedBack')
  spanBlank.innerHTML = 'You have submitted a blank answer.'
  parentBlank.appendChild(spanBlank)
}

function feedbackWrong () {                                                   // DOM manipulation when the user answers incorrectly
  var targetFeedback = document.querySelector('span#feedBack')
  targetFeedback.parentNode.removeChild(targetFeedback)

  var parentWrong = document.querySelector('div#qmFeedback')
  var spanWrong = document.createElement('span')
  spanWrong.classList.add('answer-incorrect')
  spanWrong.setAttribute('id', 'feedBack')
  spanWrong.innerHTML = 'Your answer ' + userInput + ' is incorrect.'
  parentWrong.appendChild(spanWrong)
}
