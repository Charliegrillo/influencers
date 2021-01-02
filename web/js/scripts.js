	/*
	/* Coloca la url en el contenedor despues del dragdrop
	*/
	function readUrl(input) {
		if (input.files && input.files[0]) {
			let reader = new FileReader();
			reader.onload = (e) => {
			let imgData = e.target.result;
			let imgName = input.files[0].name;
			input.setAttribute("data-title", imgName);

			var x = document.querySelector(".droply-box-file");
			x.innerHTML = imgName;
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	/*
	/* Limita a maximo tres las opciones de categoria
	*/
	var checks = document.querySelectorAll(".category[type=checkbox]");
	var max = 3;
	for (var i = 0; i < checks.length; i++)
	  checks[i].onclick = selectiveCheck;

	function selectiveCheck (event) {
	  var checkedChecks = document.querySelectorAll(".category[type=checkbox]:checked");
	  if (checkedChecks.length >= max + 1)
	    return false;
	}
	/*
	/* Controla las vista segun la vista en el primer o segundo paso
	*/
	 document.querySelector("button.step-1").addEventListener("click", function() {
          document.querySelector("li.step-item.step-2 > a.step-click").click();
        });
    document.querySelector("button.previus").addEventListener("click", function() {
      document.querySelector("li.step-item.step-1 > a.step-click").click();
    }); 

    var steps = document.querySelectorAll(".step-click");
    for (var i = 0; i < steps.length; i++)
      steps[i].onclick = stepClick;

    function stepClick (e) {
        var stepActive = document.querySelector(".step-item.active");
        if (stepActive && stepActive.classList.contains('active')) {
            stepActive.classList.remove('active');
        }
        var thisStep = e.target.closest(".step-item");
        thisStep.classList.add('active');

        var step1 = document.querySelector("section.step-1");
        var step2 = document.querySelector("section.step-2");            
        if (thisStep && thisStep.classList.contains('step-1')) {
            step1.style.display = "block";
            step2.style.display = "none";
            document.querySelector("button.step-1").style.display = "inline-block";
            var btns = document.querySelectorAll("button.step-2");
            for (var i = 0; i < btns.length; i++)
                btns[i].style.display = "none";
        } else {
            step1.style.display = "none";
            step2.style.display = "block";
            document.querySelector("button.step-1").style.display = "none";
            var btns = document.querySelectorAll("button.step-2");
            for (var i = 0; i < btns.length; i++)
                btns[i].style.display = "inline-block";                
        }           
    }
	/*
	/* Salva los datos y muestra la modal
	*/              
        document.querySelector("button.register").addEventListener("click", function() {
            $.post("update?id=1", $("#formdatos").serialize())
            // Serialization looks good: name=textInNameInput&&telefon=textInPhoneInput etc
            .done(function(data) {
                $('#modalRegister').modal('toggle');
            });
          
        });

       