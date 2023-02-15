const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();
recognition.onresult = (event) => {
    console.log(event);
    const current = event.resultIndex;
    const text = event.results[current][0].transcript;
    $('#searchL').val(text.slice(0, -1));
    setTimeout(() => {
        $('#searchBtn').click();
    }, 1000);
    speak('searching '+text);
}

function speak(sentence){
    const text_speak = new SpeechSynthesisUtterance(sentence);
    text_speak.rate = 1;
    text_speak.pitch = 1;
    text_speak.volume = 1;
    window.speechSynthesis.speak(text_speak);
}

