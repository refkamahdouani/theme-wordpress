
const txtAnim = document.querySelector('h2');

new Typewriter(txtAnim, {
 loop: true,
   deletespeed: 10
  
})

.typeString('c\'est refka Mahdouani')
    .pauseFor(2500)
 
    .typeString('<strong>,Dev Full-Stack</strong> !')
    .pauseFor(2500)
    .deleteChars(13)
    .typeString('<span style="color: #27ae60;"> CSS </span>')
    .pauseFor(2500)
    .deleteChars(05)
    .typeString('<span style="color: #800080;"> PHP </span>')
    .pauseFor(2500)
    .deleteChars(05)
    .typeString('<span style="color: #0000FF;"> JAVA </span>')
    .pauseFor(2500)
    .deleteChars(06)
    .typeString('<span style="color: #808000;"> JavaScript </span>')
    .start();

