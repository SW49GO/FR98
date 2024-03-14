document.addEventListener('DOMContentLoaded', function () {
  //////////////////Ouverture Div ajout Joueur////////////////////////////////
  let aj = document.querySelector('.add_player');
  let cont = document.querySelector('.container_addPlayer');
  if (aj != null) {
    aj.addEventListener('click', (e) => {
      e.preventDefault;
      cont.classList.toggle('hidden');
    });
  }
  /// Bouton Input Enregistrer
  let btn_input = document.getElementById('add_new_player');
  if (btn_input != null) {
    btn_input.addEventListener('click', (e) => {
      e.preventDefault;
      cont.classList.toggle('hidden');
    });
  }
  ///////////////////////Ajout d'un joueur////////////////////////////////////
  let addPlayer = document.getElementById('addPlayer');
  if (addPlayer != null) {
    addPlayer.addEventListener('submit', function (e) {
      e.preventDefault();
      let playersList = document.querySelector('.playerList');
      let newPlayer = document.getElementById('newPlayer');
      let select_grade = document.getElementById('select_grade');
      let cranePlayer = document.getElementById('cranePlayer');
      let grade, crane;
      if (!select_grade.value) {
        grade = 'white';
      } else {
        grade = select_grade.value;
      }
      if (!cranePlayer.value) {
        crane = 0;
      } else {
        crane = cranePlayer.value;
      }
      let formdata = new FormData();
      formdata.append('name', newPlayer.value);
      formdata.append('grade', grade);
      formdata.append('crane', crane);
      let obj = { method: 'POST', body: formdata };
      fetch('ajax/recordPlayer.php', obj)
        .then((res) => res.text())
        .then((data) => {
          playersList.innerHTML =
            '<div class="ins_players"><div class="ins_joueur" style="color:' +
            data['grade'] +
            '">' +
            data['name'] +
            '</div><div class="ins_crane">' +
            data['crane'] +
            ' ' +
            data['lvl'] +
            ' %</div></div>';
          newPlayer.value = '';
          select_grade.value = '';
          cranePlayer.value = '';
        })
        .catch((err) => console.error(err));
    });
  }
  ////////////////CheckBox Boosts côté Admin////////////////////
  sessionStorage.clear();
  let checkbox = document.querySelectorAll('.checkBoostPlayer');
  let choice = document.querySelector('.choice');
  let spanValid = document.querySelector('.spanValid');
  let btn_final = document.querySelector('.boostFinal');

  if (checkbox != null) {
    for (let i = 0; i < checkbox.length; i++) {
      checkbox[i].addEventListener('click', detect);
    }
  }
  function detect(e) {
    let local = JSON.parse(sessionStorage.getItem('boost')) || [];
    if (e.target.checked) {
      local.push({ id: e.target.value, active: 1 });
      sessionStorage.setItem('boost', JSON.stringify(local));
    } else {
      sessionStorage.clear();
      local.push({ id: e.target.value, active: 0 });
      sessionStorage.setItem('boost', JSON.stringify(local));
    }

    let formdata = new FormData();
    formdata.append('boost_id', sessionStorage.getItem('boost'));
    let obj = { method: 'POST', body: formdata };
    fetch('ajax/recordBoosts.php', obj)
      .then((response) => response.text())
      .then((data) => {
        let res = parseInt(choice.textContent) + parseInt(data);
        spanValid.innerHTML = '';
        if (res == 12) {
          choice.innerHTML = res;
          spanValid.innerHTML = '👍';
          btn_final.setAttribute('class', 'show');
        } else {
          choice.innerHTML = res;
          btn_final.setAttribute('class', 'hidden');
        }
      })
      .catch((err) => console.error(err));
  }

  ////////////////CheckBox Boosts côté Joueur////////////////////

  sessionStorage.clear();
  let checkboxP = document.querySelectorAll('.checkboxP');
  let votant = document.querySelector('.votant');
  let choiceP = document.querySelector('.choiceP');
  let spanValidP = document.querySelector('.spanValidP');
  let btn = document.getElementById('validVote');
  if (checkboxP != null) {
    for (let i = 0; i < checkboxP.length; i++) {
      checkboxP[i].addEventListener('click', detectP);
    }
  }
  function detectP(e) {
    let local = JSON.parse(sessionStorage.getItem('boostP')) || [];

    if (e.target.checked) {
      // ajout de celles cochées
      local.push({ id: e.target.value });
      sessionStorage.setItem('boostP', JSON.stringify(local));
    } else {
      // suppression de celles décochées
      let newArray = local.filter((key) => key.id !== e.target.value);
      sessionStorage.setItem('boostP', JSON.stringify(newArray));
    }
    let formdata = new FormData();
    formdata.append('boostP', sessionStorage.getItem('boostP'));
    let obj = { method: 'POST', body: formdata };
    fetch('ajax/recordBoostsPlayer.php', obj)
      .then((response) => response.text())
      .then((data) => {
        let resP = data;
        spanValidP.innerHTML = '';
        if (resP < 3) {
          choiceP.innerHTML = resP;
          if (!btn.classList.contains('hidden')) {
            btn.classList.toggle('hidden');
          }
        } else if (resP == 3) {
          choiceP.innerHTML = resP;
          spanValidP.innerHTML = '👍';
          btn.classList.toggle('hidden');
        } else {
          if (!btn.classList.contains('hidden')) {
            btn.classList.toggle('hidden');
          }
          choiceP.innerHTML = resP;
        }
        votant.innerHTML +=
          '<div style="color:orange; font-size:20px"><p><?=$_SESSION["player"]?>&emsp;</p></div>';
      })
      .catch((err) => console.error(err));
  }

  //////////////Récupération du nombre de crânes pour la conquête///////////////////
  let crane = document.querySelectorAll('.inputCrane');
  for (let i = 0; i < crane.length; i++) {
    crane[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = crane[i].getAttribute('name');
        let valeur = crane[i].value;
        let div = document.getElementById(id);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('crane', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordConquete.php', obj)
          .then((response) => response.text())
          .then((data) => {
            div.innerHTML = data;
            let inputCrane = div.nextSibling.firstChild;
            inputCrane.value = '';
          })
          .catch((err) => console.error(err));
      }
    });
  }
  /////////Saisie des dons//////////////////////
  ////Participation//
  let participation = document.querySelectorAll('.participationDons');
  for (let i = 0; i < participation.length; i++) {
    participation[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = participation[i].getAttribute('name');
        let valeur = participation[i].value;
        let div = participation[i].parentNode.previousSibling;
        id = id.slice(1);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('participation', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordParticipation.php', obj)
          .then((response) => response.text())
          .then((data) => {
            participation[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Base//
  let base = document.querySelectorAll('.baseDons');
  for (let i = 0; i < base.length; i++) {
    base[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = base[i].getAttribute('name');
        let valeur = base[i].value;
        id = id.slice(1);
        let div = base[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('base', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordBase.php', obj)
          .then((response) => response.json())
          .then((data) => {
            base[i].value = '';
            div.innerHTML = data['base'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Tresor//
  let tresor = document.querySelectorAll('.tresorDons');
  for (let i = 0; i < base.length; i++) {
    tresor[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = tresor[i].getAttribute('name');
        let valeur = tresor[i].value;
        id = id.slice(1);
        let div = tresor[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('tresor', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordTresor.php', obj)
          .then((response) => response.json())
          .then((data) => {
            tresor[i].value = '';
            div.innerHTML = data['tresor'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Guerre//
  let guerre = document.querySelectorAll('.guerreDons');
  for (let i = 0; i < base.length; i++) {
    guerre[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = guerre[i].getAttribute('name');
        let valeur = guerre[i].value;
        id = id.slice(1);
        let div = guerre[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append(' guerre', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordGuerre.php', obj)
          .then((response) => response.json())
          .then((data) => {
            guerre[i].value = '';
            div.innerHTML = data['guerre'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Vitesse//
  let vitesse = document.querySelectorAll('.vitesseDons');
  for (let i = 0; i < base.length; i++) {
    vitesse[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = vitesse[i].getAttribute('name');
        let valeur = vitesse[i].value;
        id = id.slice(1);
        let div = vitesse[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append(' vitesse', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordVitesse.php', obj)
          .then((response) => response.json())
          .then((data) => {
            vitesse[i].value = '';
            div.innerHTML = data['vitesse'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Perle//
  let perle = document.querySelectorAll('.perleDons');
  for (let i = 0; i < base.length; i++) {
    perle[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = perle[i].getAttribute('name');
        let valeur = perle[i].value;
        id = id.slice(2);
        let div = perle[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append(' perle', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordPerle.php', obj)
          .then((response) => response.json())
          .then((data) => {
            perle[i].value = '';
            div.innerHTML = data['perle'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Insta//
  let insta = document.querySelectorAll('.instaDons');
  for (let i = 0; i < base.length; i++) {
    insta[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = insta[i].getAttribute('name');
        let valeur = insta[i].value;
        id = id.slice(1);
        let div = insta[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append(' insta', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordInsta.php', obj)
          .then((response) => response.json())
          .then((data) => {
            insta[i].value = '';
            div.innerHTML = data['insta'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Fonte//
  let fonte = document.querySelectorAll('.fonteDons');
  for (let i = 0; i < base.length; i++) {
    fonte[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = fonte[i].getAttribute('name');
        let valeur = fonte[i].value;
        id = id.slice(1);
        let div = fonte[i].parentNode.previousSibling;
        let participation = div.parentNode.childNodes[1];
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('fonte', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordFonte.php', obj)
          .then((response) => response.json())
          .then((data) => {
            fonte[i].value = '';
            div.innerHTML = data['fonte'];
            participation.innerHTML = data['participation'];
          })
          .catch((err) => console.error(err));
      }
    });
  }

  //////Configuration PLayers///////
  let config = document.querySelectorAll('.ins_config');
  for (let i = 0; i < config.length; i++) {
    config[i].addEventListener('click', () => {
      let div = config[i].nextSibling;
      div.classList.toggle('hidden');
    });
  }
  ///////Nombres de Caractères saisie dans Règle//////////////
  let nbCar = document.getElementById('nbCar');
  let text = document.querySelector('.regles');
  let btnCar = document.querySelector('.btnCar');
  let nbRegles = document.querySelector('.nbRegles');
  if (text != null) {
    text.value = '';
    text.addEventListener('keyup', (e) => {
      if (e.key != 8) {
        if (e.target.value != '') {
          nbCar.textContent = 300 - e.target.value.trim().length;
        }
      } else {
        nbCar.textContent = nbCar.textContent + e.target.value.trim().length;
      }
      if (nbCar.textContent < 0) {
        nbCar.style.color = 'red';
        text.style.color = 'red';
      } else {
        nbCar.style.color = 'white';
        text.style.color = 'black';
      }
      if (nbCar.textContent < 0) {
        btnCar.classList.toggle('hidden');
      } else {
        if (btnCar.classList.contains('hidden')) {
          btnCar.classList.toggle('hidden');
        }
      }
    });

    //////////Enregitrement des règles/////////////
    let reglesPlayer = document.querySelector('.reglesPlayer');

    if (btnCar != null) {
      btnCar.addEventListener('click', () => {
        ///Enregistrement nouvelle règle
        let formdata = new FormData();
        formdata.append('comment', text.value);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordRegles.php', obj)
          .then((response) => response.json())
          .then((data) => {
            reglesPlayer.innerHTML +=
              '<div class="containerRegle" id="' +
              data['id'] +
              '"><h4 class="titleRegle">Règle N° : ' +
              data['nb'] +
              '</h4><div class="toolRegle"><input class="supprRegle" type="button" title="Supprimer"><input class="modifyRegle" type="button" title="Modifier"></div><span style="color:white">[' +
              data['author'] +
              ']</span><div class="commentRegles"><p style="color:black">' +
              data['comment'] +
              '</p></div></div>';
            text.value = '';
            nbRegles.innerHTML = data['nb'] + 1;
            location.reload();
          })
          .catch((err) => console.error(err));
      });
    }

    /////////Editer une règles
    let modifyRegle = document.querySelectorAll('.modifyRegle');
    let textA = document.querySelector('.regles');
    for (let i = 0; i < modifyRegle.length; i++) {
      modifyRegle[i].addEventListener('click', () => {
        let idMod = modifyRegle[i].parentNode.parentNode.id;
        let formdata = new FormData();
        formdata.append('id', idMod);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/editRegle.php', obj)
          .then((res) => res.json())
          .then((data) => {
            textA.value = data['comment'];
            textA.id = data['id'];
            btnCar.remove();
            let newBtn = document.createElement('button');
            let txtBtn = document.createTextNode('Modifier');
            newBtn.appendChild(txtBtn);
            newBtn.className = 'validModif newBtn';
            document.querySelector('.newRegles').appendChild(newBtn);
            ////Modification d'une règle
            let chgText =
              modifyRegle[i].parentNode.parentNode.querySelector(
                '.commentRegles'
              ).firstChild;
            if (newBtn != null) {
              newBtn.addEventListener('click', () => {
                let formdata = new FormData();
                formdata.append('id', data['id']);
                formdata.append('comment', text.value);
                let obj = { method: 'POST', body: formdata };
                fetch('ajax/modifyRegle.php', obj)
                  .then((res) => res.text())
                  .then((data) => {
                    chgText.innerHTML = data;
                    text.value = '';
                    newBtn.remove();
                    location.reload();
                  })
                  .catch((err) => console.error(err));
              });
            }
          })
          .catch((err) => console.error(err));
      });
    }
  }

  /////////Supprimer une règle
  let supprRegle = document.querySelectorAll('.supprRegle');
  for (let i = 0; i < supprRegle.length; i++) {
    supprRegle[i].addEventListener('click', () => {
      let idSup = supprRegle[i].parentNode.parentNode.id;
      let divSup =
        supprRegle[i].parentNode.parentNode.querySelector('.commentRegles');

      let formdata = new FormData();
      formdata.append('id', idSup);
      let obj = { method: 'POST', body: formdata };
      fetch('ajax/deleteRegle.php', obj)
        .then((res) => res.text())
        .then((data) => {
          nbRegles.innerHTML = nbRegles.innerHTML - 1;
          divSup.parentNode.remove();
        })
        .catch((err) => console.error(err));
    });
  }

  /////////Saisie de la Conquête//////////////////////
  ////Batiments Troupe//
  let batT = document.querySelectorAll('.batiment_t');
  for (let i = 0; i < batT.length; i++) {
    batT[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = batT[i].getAttribute('name');
        let valeur = batT[i].value;
        let div = batT[i].parentNode.previousSibling;
        id = id.slice(1);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('bat_t', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordBatTroupe.php', obj)
          .then((response) => response.text())
          .then((data) => {
            batT[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Batiments Sagesse//
  let batS = document.querySelectorAll('.batiment_s');
  for (let i = 0; i < batS.length; i++) {
    batS[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = batS[i].getAttribute('name');
        let valeur = batS[i].value;
        let div = batS[i].parentNode.previousSibling;
        id = id.slice(1);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('bat_s', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordBatSagesse.php', obj)
          .then((response) => response.text())
          .then((data) => {
            batS[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Batiments Pierre//
  let batP = document.querySelectorAll('.batiment_p');
  for (let i = 0; i < batP.length; i++) {
    batP[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = batP[i].getAttribute('name');
        let valeur = batP[i].value;
        let div = batP[i].parentNode.previousSibling;
        id = id.slice(1);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('bat_p', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordBatPierre.php', obj)
          .then((response) => response.text())
          .then((data) => {
            batP[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Dons Troupes//
  let donT = document.querySelectorAll('.don_t');
  for (let i = 0; i < donT.length; i++) {
    donT[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = donT[i].getAttribute('name');
        let valeur = donT[i].value;
        let div = donT[i].parentNode.previousSibling;
        id = id.slice(2);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('don_t', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordDonTroupe.php', obj)
          .then((response) => response.text())
          .then((data) => {
            donT[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Dons Sagesses//
  let donS = document.querySelectorAll('.don_s');
  for (let i = 0; i < donS.length; i++) {
    donS[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = donS[i].getAttribute('name');
        let valeur = donS[i].value;
        let div = donS[i].parentNode.previousSibling;
        id = id.slice(2);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('don_s', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordDonSagesse.php', obj)
          .then((response) => response.text())
          .then((data) => {
            donS[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Dons Pierres//
  let donP = document.querySelectorAll('.don_p');
  for (let i = 0; i < donP.length; i++) {
    donP[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = donP[i].getAttribute('name');
        let valeur = donP[i].value;
        let div = donP[i].parentNode.previousSibling;
        id = id.slice(2);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('don_p', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordDonPierre.php', obj)
          .then((response) => response.text())
          .then((data) => {
            donP[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Crânes//
  let craneC = document.querySelectorAll('.conq_c');
  for (let i = 0; i < craneC.length; i++) {
    craneC[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = craneC[i].getAttribute('name');
        let valeur = craneC[i].value;
        let div = craneC[i].parentNode.previousSibling;
        id = id.slice(5);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('crane', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordConqCrane.php', obj)
          .then((response) => response.text())
          .then((data) => {
            craneC[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Participations//
  let part = document.querySelectorAll('.conq_p');
  for (let i = 0; i < part.length; i++) {
    part[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = part[i].getAttribute('name');
        let valeur = part[i].value;
        let div = part[i].parentNode.previousSibling;
        id = id.slice(4);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('participation', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordConqPart.php', obj)
          .then((response) => response.text())
          .then((data) => {
            part[i].value = '';
            div.innerHTML = data;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Ninjas//
  let ninja = document.querySelectorAll('.p_ninja');
  for (let i = 0; i < ninja.length; i++) {
    ninja[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = ninja[i].getAttribute('name');
        let valeur = ninja[i].value;
        let div = ninja[i].parentNode.previousSibling;
        id = id.slice(5);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('ninja', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordNinjaPart.php', obj)
          .then((response) => response.text())
          .then((data) => {
            let total = div.parentNode.querySelector('.total');
            let result = parseInt(total.textContent) + parseInt(valeur);
            ninja[i].value = '';
            div.innerHTML = data;
            total.innerHTML = result;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  ////Guerre//
  let guerrePart = document.querySelectorAll('.p_guerre');
  for (let i = 0; i < guerrePart.length; i++) {
    guerrePart[i].addEventListener('keypress', (e) => {
      if (e.keyCode === 13) {
        let id = guerrePart[i].getAttribute('name');
        let valeur = guerrePart[i].value;
        let div = guerrePart[i].parentNode.previousSibling;
        id = id.slice(6);
        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('guerre', valeur);
        let obj = { method: 'POST', body: formdata };
        fetch('ajax/recordGuerrePart.php', obj)
          .then((response) => response.text())
          .then((data) => {
            let total = div.parentNode.querySelector('.total');
            let result = parseInt(total.textContent) + parseInt(valeur);
            guerrePart[i].value = '';
            div.innerHTML = data;
            total.innerHTML = result;
          })
          .catch((err) => console.error(err));
      }
    });
  }
  // Soumission Téléchargement fichier Excel
  let inputFile = document.getElementById('file_excel');
  inputFile.addEventListener('change', () => {
    document.getElementById('form_excel').submit();
  });
  // Ouverture des images dans une Div
  let divExcel = document.querySelectorAll('.eachFile');
  let divDest = document.querySelector('.show_excel');
  for (let i = 0; i < divExcel.length; i++) {
    divExcel[i].addEventListener('click', () => {
      let img = divExcel[i].childNodes[0].src;
      divDest.className += ' show_img';
      divDest.innerHTML = '<img src="' + img + '" alt="excel">';
    });
  }
  // Supression d'une image excel
  let supprExcel = document.querySelectorAll('.suppr_excel');
  for (let i = 0; i < supprExcel.length; i++) {
    supprExcel[i].addEventListener('click', () => {
      let nameSuppr = supprExcel[i].nextSibling.childNodes[0].src;
      let res = nameSuppr.split('/');
      let name = res[res.length - 1];
      let idSuppr = supprExcel[i].nextSibling.id;
      let formdata = new FormData();
      formdata.append('id', idSuppr);
      formdata.append('name', name);
      let obj = { method: 'POST', body: formdata };
      fetch('ajax/supprExcel.php', obj)
        .then((response) => response.text())
        .then((data) => {
          location.reload();
        })
        .catch((err) => console.error(err));
    });
  }
});
