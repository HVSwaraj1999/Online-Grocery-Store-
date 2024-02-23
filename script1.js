`use strict`;
function refreshTime() {
  const timeDisplay = document.getElementById("time");
  const dateString = new Date().toLocaleString();
  const formattedString = dateString.replace(", ", " - ");
  timeDisplay.textContent = formattedString;
}
setInterval(refreshTime, 50);




document.addEventListener("DOMContentLoaded", function () {
    const questions = [
        {
            question: "Are you a student?",
            offer: "Because you're a student, you qualify for 10% off your purchase!",
        },
        {
            question: "Are you a low-income person?",
            offer: "Because you're a low-income person and you're a student, you qualify for $100 off your purchase!",
        },
        {
            question: "Do you have a special coupon code?",
            offer: "Because you have a special coupon code, you're a low-income person and you're a student, you qualify for 20% off your purchase!",
        },
    ];

    let currentQuestionIndex = 0;
    let startTime = null;

    const questionContainer = document.getElementById("question-container");
    const resultContainer = document.getElementById("result-container");
    const qualificationText = document.getElementById("qualification");
    const offerText = document.getElementById("offer");
    const timeSpentText = document.getElementById("time-spent");

    const answerForm = document.getElementById("answer-form");
    const nextButton = document.getElementById("next-question");
    const skipButton = document.getElementById("skip-question");
    const startButton = document.getElementById("start-questions");

    function displayQuestion(index) {
        questionContainer.style.display = "block";
        resultContainer.style.display = "none";
        questionContainer.style.display = "block";
        if (index < questions.length) {
            document.getElementById("question").textContent = questions[index].question;
            answerForm.style.display = "block";
        } else {
            answerForm.style.display = "none";
            showResults();
        }
    }

    function showResults() {
        const endTime = new Date();
        const timeSpent = (endTime - startTime) / 1000; // Calculate time spent in seconds
        const offer = calculateSpecialOffer();
        qualificationText.textContent = `Congratulations! You qualify for a special offer.`;
        offerText.textContent = offer;
        timeSpentText.textContent = `Time spent on questions: ${timeSpent} seconds`;
        resultContainer.style.display = "block";
    }

    function calculateSpecialOffer() {
        let offer = "";
        if (answers[0] === "yes") {
            offer = questions[0].offer ;
        }
        if (answers[1] === "yes"&&answers[0] === "yes") {
            offer = questions[1].offer ;
        }
        if (answers[2] === "yes"&&answers[1] === "yes"&&answers[0] === "yes") {
            offer = questions[2].offer;
        }
        return offer;
    }

    let answers = new Array(questions.length);

    answerForm.addEventListener("change", function (event) {
        const selectedValue = event.target.value;
        answers[currentQuestionIndex] = selectedValue;
    });

    startButton.addEventListener("click", function () {
        currentQuestionIndex = 0;
        startTime = new Date();
        displayQuestion(currentQuestionIndex);
    });

    nextButton.addEventListener("click", function () {
        currentQuestionIndex++;
        displayQuestion(currentQuestionIndex);
    });

    skipButton.addEventListener("click", function () {
        currentQuestionIndex++;
        displayQuestion(currentQuestionIndex);
    });
});
