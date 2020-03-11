<?php
include './phpfiles.php';
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['userId'])) {
  header('Location: ./index.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="manifest" href="manifest.json" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="apple-touch-icon" href="Images/icons/icon-192x192.png" />
  <meta name="apple-mobile-web-app-status-bar" content="#00adb5" />
  <meta name="theme-color" content="#00adb5" />
  <link rel="stylesheet" href="Scripts and Sheets/main.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <title>BE Project</title>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav container-fluid">
        <li class="nav-item">
          <a class="nav-link font-weight-bold" href="#" onclick="changeSection(0)">Home
          </a>
        </li>
        <li class="nav-item ">
          <a id="deviceData" class="nav-link font-weight-bold" href="#" onclick="changeSection(1)">Device Data
          </a>
        </li>
        <li class="nav-item ">
          <a id="profile" class="nav-link font-weight-bold" href="#" onclick="changeSection(2)">Profile
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="./phpfiles.php">
            <input type="submit" name="logout" class="nav-link font-weight-bold text-danger" value="Logout" />
          </form>
        </li>
      </ul>
    </div>
  </nav>
  <section id="home" class="container-fluid p-0 section row">
    <canvas id="myChart" class="col-lg-6 container"></canvas>
    <canvas id="myChart1" class="col-lg-6 container"></canvas>
  </section>
  <section id="deviceData" class="container-fluid p-0 section hide-it">
    <div class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <h1>DETAILS ABOUT THE CROP</h1>
        <p class="filleddata"></p>
        <p class="incompletedata">
          Fill the form to configure the device according to the data
        </p>
      </div>
    </div>
    <form method="POST" id="cropData" class="row p-3" action="./phpfiles.php">
      <div class="col-sm-4 form-group ">
        <label for="cropName">Crop's Name : </label>
        <br />
        <input class="form-control" type="text" required id="cropName" placeholder="Crop's Name" name="cropName" />
      </div>
      <div class="col-sm-4 form-group ">
        <label for="soilType">Soil's Type : </label>
        <br />
        <input class="form-control" type="text" required id="soilType" placeholder="Soil's Name" name="soilType" />
      </div>
      <div class="col-sm-4 form-group ">
        <label for="threshold">Threshold for the given crop: </label>
        <br />
        <input class="radio" type="radio" required name="threshold" value="Low" />
        Low
        <br />
        <input class="radio" type="radio" required name="threshold" value="Medium" />
        Medium
        <br />
        <input class="radio" type="radio" required name="threshold" value="High" />
        High
      </div>
      <input class="btn btn-primary rounded btn-md align-center my-auto mx-auto" type="submit" value="Submit" name="submit" />
    </form>
  </section>
  <section id="profile" class="section hide-it">
    <div class="image-container">
      <div class="text">
        <h2 class="text-center">Profile</h2>
        <hr />
        <h4 class="text-center">Device ID</h4>
        <h5 class="text-center">
          <?php
          echo $_SESSION['userId'];
          ?>
        </h5>
      </div>
    </div>
  </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="./Scripts and Sheets/main.js"></script>
<script>
  if ("serviceWorker" in navigator) {
    window.addEventListener("load", function() {
      navigator.serviceWorker.register("serviceWorker.js").then(
        function(registration) {
          // Registration was successful
          console.log(
            "ServiceWorker registration successful with scope: ",
            registration.scope
          );
        },
        function(err) {
          // registration failed :(
          console.log("ServiceWorker registration failed: ", err);
        }
      );
    });
  }
  var ctx = document.getElementById("myChart").getContext("2d");
  var myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [],
      datasets: [{
        data: [],
        label: "Soil Moisture",
        backgroundColor: ["rgba(255, 99, 132,0.2)"],
        borderColor: ["rgb(255, 99, 132)"],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            stepSize: 10,
          }
        }]
      }
    }
  });
  var ctx1 = document.getElementById("myChart1").getContext("2d");
  var myChart1 = new Chart(ctx1, {
    type: "line",
    data: {
      labels: [],
      datasets: [{
        label: "Rain Drop",
        data: [],
        backgroundColor: ["rgba(64, 224, 208, 0.28)"],
        borderColor: ["rgb(114, 181, 183)"],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            stepSize: 10,
          }
        }]
      }
    }
  });

  function getData() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        addSoilData(myObj.soil, myObj.time.toString(10).slice(11));
        addRainData(myObj.rain, myObj.time.toString(10).slice(11));
      }
    };
    xmlhttp.open("GET", "./getData.php", true);
    xmlhttp.send();
  }

  function addSoilData(soil, time) {
    soil = Math.abs(Math.ceil(((soil*100)/1024)-100));
    if (myChart.data.datasets[0].data.length > 5) {
      myChart.data.datasets[0].data.shift(0);
      myChart.data.labels.shift(0);
    } else {
      myChart.data.labels.push(`${time}`);
      myChart.data.datasets[0].data.push(soil);
      myChart.update();
    }
  }

  function addRainData(rain, time) {
    rain = Math.abs(Math.ceil(((rain*100)/1024)-100));
    if (myChart1.data.datasets[0].data.length > 5) {
      myChart1.data.datasets[0].data.shift(0);
      myChart1.data.labels.shift(0);
    } else {
      myChart1.data.labels.push(`${time}`);
      myChart1.data.datasets[0].data.push(rain);
      myChart1.update();
    }
  }
  <?php
  if (isset($_SESSION['dataFilled'])) {
    echo "filledData();";
  } else {
    echo "fillData();";
  }
  ?>
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>