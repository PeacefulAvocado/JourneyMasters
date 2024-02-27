function bekuld()
  {
    if (document.getElementById('honnan').value == "" || document.getElementById('celpont').value == "" || document.getElementById('daterange').value == "")
    {
      alert("Adjon meg minden adatot!");
    }
    else {
      var datum = ((document.getElementById('daterange').value).replaceAll(' ', '')).split('-');

      console.log(datum[0])

      var f = document.getElementById("hely");
      var hidden = document.createElement("input");
      hidden.type = "hidden";
      hidden.name = "honnan";
      hidden.value = document.getElementById('honnan').value;
      f.appendChild(hidden);

      var hidden2 = document.createElement("input");

      hidden2.type = "hidden";
      hidden2.name = "mettol";
      hidden2.value = datum[0].replaceAll('/', '-');
      f.appendChild(hidden2);

      var hidden3 = document.createElement("input");

      hidden3.type = "hidden";
      hidden3.name = "meddig";
      hidden3.value = datum[1].replaceAll('/', '-');
      f.appendChild(hidden3);
      f.submit();
    }
    
  }