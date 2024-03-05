function bekuld(szam)
  {
    if (document.getElementById('honnan').value == "" || document.getElementById('daterange').value == "")
    {
      alert("Adjon meg minden adatot!");
    }
    else {
      var datum = ((document.getElementById('daterange').value).replaceAll(' ', '')).split('-');

      var f = document.getElementById("hely"+String(szam));
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

  function send_foglalas(utasok_szama) {
    let count = 0;
    for (let i = 0; i < utasok_szama; i++) {
      var nev = document.getElementsByName("nev_" + i)[0].value;
      var szulid = document.getElementsByName("szulid_" + i)[0].value;
      var nem = document.getElementsByName("nem_" + i)[0].value;
      var igtipus = document.getElementsByName("igtipus_" + i)[0].value;
      var orszag = document.getElementsByName("orszag_" + i)[0].value;
      var irszam = document.getElementsByName("irszam_" + i)[0].value;
      var varos = document.getElementsByName("varos_" + i)[0].value;
      var lakcim = document.getElementsByName("lakcim_" + i)[0].value;
      var tel = document.getElementsByName("tel_" + i)[0].value;
      var igszam = document.getElementsByName("igszam_" + i)[0].value;
        /*console.log("Checking values for passenger " + (i + 1));
        console.log("Name input:", nev);
        console.log("Birth ID input:", szulid);
        console.log("Identity type input:", igtipus);
        console.log("Address input:", lakcim);
        console.log("Telephone input:", tel);
        console.log("ID number input:", igszam);*/
        if (nev != "" && szulid != "" && nem != "" && igtipus != "" && lakcim != "" && orszag != "" && varos != "" && irszam != "" && tel != "" && igszam != "") {
            count++;
        }
    }

    if (count == utasok_szama) {
        console.log("sendable");
        document.getElementById("send_utazasmod").value = document.getElementById("utazas").value;
        document.getElementById("tovabb_form").submit();
    } else {
        alert("Minden utas minden adatát adja meg!");
    }
}

function send_profil()
{
  if (document.getElementById('nev').value == "" || document.getElementById('tel').value == "" || document.getElementById('szulid').value == "" || document.getElementById('orszag').value == "" || document.getElementById('irszam').value == "" || document.getElementById('varos').value == ""  || document.getElementById('lakcim').value == ""  || document.getElementById('igszam').value == "")
  {
    alert("Adjon meg minden adatot!");
  }
  else {
    var form = document.getElementById('edit');
    form.submit();
  }
}
