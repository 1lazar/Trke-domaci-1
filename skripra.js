function proveriFormuZaUnosAuta() {
    if (
      (document.getElementById("marka").value == "" &&
        document.getElementById("model").value == "" &&
        document.getElementById("godProizvodnje").value == "") ||
      (document.getElementById("marka").value != "" &&
        document.getElementById("model").value == "" &&
        document.getElementById("godProizvodnje").value == "") ||
      (document.getElementById("marka").value == "" &&
        document.getElementById("model").value != "" &&
        document.getElementById("godProizvodnje").value == "") ||
      (document.getElementById("marka").value == "" &&
        document.getElementById("model").value == "" &&
        document.getElementById("godProizvodnje").value != "") ||
      (document.getElementById("marka").value != "" &&
        document.getElementById("model").value != "" &&
        document.getElementById("godProizvodnje").value == "") ||
      (document.getElementById("marka").value != "" &&
        document.getElementById("model").value == "" &&
        document.getElementById("godProizvodnje").value != "") ||
      (document.getElementById("marka").value == "" &&
        document.getElementById("model").value !== "" &&
        document.getElementById("godProizvodnje").value != "")
    ) {
      alert("Morate popuniti sve podatke o automobilu!");
      return;
    }
  }

  function prikaziBlokove(nizBlokova, div) {
    for (const blok of nizBlokova) {
      document.getElementById(blok).style.display = "inline";
    }
    document.getElementById(div).style.display = "none";
  }

  function proveriFormuZaVozaca() {
    if (document.getElementById("imeNovogVozaca").value == "" && 
        document.getElementById("prezimeNovogVozaca").value == "") {
      confirm("Morate uneti ime vozaca!");
      return;
    }
  
    if (
      (document.getElementById("markaNovogAuta").value != "" &&
        document.getElementById("modelNovogAuta").value == "" &&
        document.getElementById("godProiz").value >= 1930) ||
      (document.getElementById("markaNovogAuta").value == "" &&
        document.getElementById("modelNovogAuta").value != "" &&
        document.getElementById("godProiz").value >= 1930) ||
      (document.getElementById("markaNovogAuta").value == "" &&
        document.getElementById("modelNovogAuta").value == "" &&
        document.getElementById("godProiz").value < 1930) ||
      (document.getElementById("markaNovogAuta").value != "" &&
        document.getElementById("modelNovogAuta").value != "" &&
        document.getElementById("godProiz").value < 1930) ||
      (document.getElementById("markaNovogAuta").value != "" &&
        document.getElementById("modelNovogAuta").value == "" &&
        document.getElementById("godProiz").value >= 1930) ||
      (document.getElementById("markaNovogAuta").value == "" &&
        document.getElementById("modelNovogAuta").value != "" &&
        document.getElementById("godProiz").value >= 1930)
    ) {
      alert("Popunite ispravno podatke auta!");
    }
  }

  function proveriFormuZaBrisanjeVozaca() {
    if (
    (document.getElementById("imeNovogVozaca").value != "" ||
      document.getElementById("prezimeNovogVozaca").value != "") )
      {
      alert(
        "Ne smete popunjavati podatke o piscu ili knjizi ukoliko brišete postojeću knjigu!"
      );
    }
  }

  function skloniBlokove(nizBlokova, div) {
    for (const blok of nizBlokova) {
      document.getElementById(blok).style.display = "none";
    }
    document.getElementById(div).style.display = "inline";
  }