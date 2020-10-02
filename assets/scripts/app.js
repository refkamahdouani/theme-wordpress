var app = document.getElementById('app');

var typewriter = new Typewriter(app, {
    loop: true
});

typewriter.typeString('c\'est refka Mahdouani')
    .pauseFor(2500)
    .deleteAll()
    .typeString('<strong>,Dev Full-Stack</strong> !')
    .pauseFor(2500)
    .deleteChars(13)
    .typeString('<span style="color: 27ae60;"> CSS </span>')
    .pauseFor(2500)
    .deleteChars(05)
    .typeString('<span style="color: 0fffff;"> PHP </span>')
    .pauseFor(2500)
    .deleteChars(05)
    .typeString('<span style="color: rfbfgf;"> JAVA </span>')
    .pauseFor(2500)
    .deleteChars(06)
    .typeString('<span style="color: cvfvf;"> Javascript </span>')
    .start();