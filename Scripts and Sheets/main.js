let loginForm = document.getElementById("login-form");
let registerForm = document.getElementById("register-form");
let sections = document.getElementsByClassName("section");
let deviceData = document.getElementById("deviceData");
let form = [loginForm, registerForm];
function formVisibility() {
  registerForm.style.visibility = "hidden";
  setTimeout(() => {
    registerForm.style.visibility = "visible";
  }, 700);
}
function toggleClassOne() {
  form.map(i => {
    i.classList.toggle("hide-that");
    i.classList.toggle("reveal-that");
  });
}
function changeSection(i) {
  for (let j = 0; j < sections.length; j++) {
    sections[j].classList.toggle("hide-it", true);
  }
  sections[i].classList.toggle("hide-it", false);
}
function filledData() {
  deviceData.classList.add("disabled");
  deviceData.parentNode.style.display = "none";
  setInterval(getData, 7500);
}

function fillData() {
  deviceData.click();
  window.alert("Enter The Details To Start Mapping The Sensor's Data");
}

// db.collection('iotData').get().then((snapshot)=>{
// snapshot.docs.forEach(doc =>{
// });
// });
// function getData1(){
// let a = new Date();
// db.collection('iotData').add({
//   time:`${a.getTime()}`,
//   soil:Math.floor(Math.random()*3),
//   rain:Math.floor(Math.random()*3),
//   motor:Math.floor(Math.random()*2)
// })
// }
// setInterval(getData1, 10000);
// db.collection("iotData").orderBy("time","desc").limit(1)
//     .onSnapshot((snapshot)=> {
//       snapshot.docs.forEach(doc=>{
//         let data = doc.data();
//         let a = new Date(parseInt(data.time));
//         let time = `${a.getHours()}:${a.getMinutes()}:${a.getSeconds()}`;
//         addSoilData(data.soil,time);
//         addRainData(data.rain,time);
//       })
//     });
