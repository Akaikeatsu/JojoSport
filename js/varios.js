function pintaTablaProductos(){
	var objRequest = new XMLHttpRequest();
	var sURL = "control/ctrlTabProductos.php";
		
		objRequest.open("POST", sURL, true);
		/*Al evento onreadystatechange se le asigna
			una función anónima*/
		objRequest.onreadystatechange=function() {
			/*Si, cuando se ejecute la llamada, queda 
				en estado 4 y status 200, es que todo 
				salió bien y puede procesar la respuesta */
			if (objRequest.readyState === 4 && 
				objRequest.status === 200) {
					ProsPinTabProd(objRequest.responseText);
			}
		};
		objRequest.send();
	}	
			
	function ProsPinTabProd(textoRespuesta){		
	var oNodoDiv = document.getElementById("catalogo");
	var oDatos;
	var sError = "";
	var oCretArtc;
	var oCretAdd1,oCretAdd2,oCretAdd3,oFilter,oOption;
		/*El texto (cadena) de respuesta de la llamada se 
		  convierte al objeto equivalente JSON (objeto con
		  atributos. Se espera sSit, sNom, nTipo)*/
		try{
			oDatos = JSON.parse(textoRespuesta);
			/*Si lo pudo convertir a objeto, entonces muestra 
			  su información bajo el formulario*/
			if (oDatos !== null){
				if (oNodoDiv != null){
					if (oDatos.success){
							
							oRepl=document.getElementById("container");
							oCretArtc=document.createElement("div");
							oCretArtc.id = "container";				
							oNodoDiv.className="principal"
							oNodoDiv.replaceChild(oCretArtc,oRepl);
							pintaSelector();																			
						for(var i=0; i< oDatos.arrProductos.length; i++){
							oRepl = document.createElement("div");
							oRepl.id = "productoMuestra";							
							oCretArtc.appendChild(oRepl);
							
							oCretAdd1=document.createElement("img");
							oCretAdd1.src=oDatos.arrProductos[i].sImg;
							oRepl.appendChild(oCretAdd1);

							oCretAdd1=document.createElement("label");
							oCretAdd1.id="nombre";
							oCretAdd1.innerHTML=oDatos.arrProductos[i].sNomProducto;
							oRepl.appendChild(oCretAdd1);

							oCretAdd1=document.createElement("p");
							oCretAdd1.innerHTML="Equipo: "+oDatos.arrProductos[i].sEquipo;
							oRepl.appendChild(oCretAdd1);

							oCretAdd1=document.createElement("p");
							oCretAdd1.innerHTML="Disciplina: "+oDatos.arrProductos[i].sDisciplina;
							oRepl.appendChild(oCretAdd1);

							oCretAdd3=document.createElement("label");
							oCretAdd3.id="detalles";		
							oRepl.appendChild(oCretAdd3);

							oCretAdd2=document.createElement("form");
							oCretAdd2.id="productoMuestraForm";
							oCretAdd2.setAttribute("onsubmit",'pintaProducto('+oDatos.arrProductos[i].nCveProd+');return false;');
							oCretAdd3.appendChild(oCretAdd2);

							oCretAdd1 = document.createElement("input");
							oCretAdd1.id = "productoMuestrasubmit";
							oCretAdd1.type = "submit";
							oCretAdd1.value = "Detalles";
							oCretAdd2.appendChild(oCretAdd1);
						}
						
					}else{
						//Error "de negocio"
						sError = oDatos;
					}
				}else{
					//Error "de codificación" (no encontró el nodo)
					sError = "Problemas en HTML";
				}
			}else{
				//Error en JSON
				sError = "Error al recibir la respuesta del servidor";
			}
		}catch(excep){
			sError = excep.message;
			oNodoDiv.innerHTML = '<h4>'+textoRespuesta+'</h4>';
		}
		if (sError != "")
			alert(sError);
	}

	function pintaFiltrado(){
		var objRequest = new XMLHttpRequest();
		var sURL = "control/ctrlFilProducto.php";
		var T1 = document.getElementById("filter1");		
		var T2 = document.getElementById("filter2");
		var Choosed = "txtcontrol="+T1.options[T1.selectedIndex].value+"&txtbuscado="+T2.options[T2.selectedIndex].value;

			objRequest.open("POST", sURL, true);
			objRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			/*Al evento onreadystatechange se le asigna
				una función anónima*/
			objRequest.onreadystatechange=function() {
				/*Si, cuando se ejecute la llamada, queda 
					en estado 4 y status 200, es que todo 
					salió bien y puede procesar la respuesta */
				if (objRequest.readyState === 4 && 
					objRequest.status === 200) {
						ProsPinTabProd(objRequest.responseText);
				}
			};
			objRequest.send(Choosed);
			}

	function pintaSelector(){
		var objRequest = new XMLHttpRequest();
		var sURL = "control/ctrlFillFiltrado.php";
			objRequest.open("POST", sURL, true);
			/*Al evento onreadystatechange se le asigna
				una función anónima*/
			objRequest.onreadystatechange=function() {
				/*Si, cuando se ejecute la llamada, queda 
					en estado 4 y status 200, es que todo 
					salió bien y puede procesar la respuesta */
				if (objRequest.readyState === 4 && 
					objRequest.status === 200) {
						ProsPinSelector(objRequest.responseText);
				}
			};
			objRequest.send();
			}

		function ProsPinSelector(textoRespuestaFill){
			var oNodoFill = document.getElementById("container");
			var sError = "";
			var oCretAdd1;
			var oFilter,oOption;
				/*El texto (cadena) de respuesta de la llamada se 
					convierte al objeto equivalente JSON (objeto con
					atributos. Se espera sSit, sNom, nTipo)*/
				try{
					oFill = JSON.parse(textoRespuestaFill);
					/*Si lo pudo convertir a objeto, entonces muestra 
						su información bajo el formulario*/
					if (oFill !== null){
						if (oNodoFill != null){
							if (oFill.success){							
								/* FILTRADO*/
							oCretAdd1=document.createElement("form");
							oCretAdd1.className="MenuFill";
							oCretAdd1.setAttribute("onsubmit",'pintaFiltrado(); return false;')
							oNodoFill.appendChild(oCretAdd1);

							oFilter = document.createElement("select");
							oFilter.id="filter1";
							oFilter.onchange=function(){
								var ofill;
								var oOption;
								oFilter = document.getElementById("filter2");
								ofill = document.createElement("select");
								ofill.id = "filter2";
								oCretAdd1.replaceChild(ofill,oFilter);
								var selectBox = document.getElementById("filter1");
								var selectedValue = selectBox.options[selectBox.selectedIndex].value;	

    							if(selectedValue == "sEquipo"){
									for(var i=0; i< oFill.arrEquipo.length; i++){
									oOption = document.createElement("option");
									oOption.text = oFill.arrEquipo[i].sEquipo;
									ofill.appendChild(oOption);}
								
								}else if(selectedValue == "sDisciplina"){
									for(var i=0; i< oFill.arrDisciplina.length; i++){
										oOption = document.createElement("option");
										oOption.text = oFill.arrDisciplina[i].sDisciplina;
										ofill.appendChild(oOption);

									}
								}
							}
							
							oCretAdd1.appendChild(oFilter);

							oOption = document.createElement("option");
							oOption.text = "Equipo";
							oOption.value = "sEquipo";							
							oFilter.appendChild(oOption);

							oOption = document.createElement("option");
							oOption.text = "Disciplina";
							oOption.value = "sDisciplina";							
							oFilter.appendChild(oOption);

							oFilter = document.createElement("select");
							oFilter.id="filter2";
							oCretAdd1.appendChild(oFilter);

							for(var i=0; i< oFill.arrEquipo.length; i++){
								oOption = document.createElement("option");
								oOption.text = oFill.arrEquipo[i].sEquipo;
								oFilter.appendChild(oOption);}
							
							oFilter = document.createElement("input");
							oFilter.className="Filtrado"
							oFilter.type = "submit";
							oCretAdd1.appendChild(oFilter);							
							/*FILTRADO */
							}else{
								//Error "de negocio"
								sError = oFill;
								oNodoDiv.innerHTML = '<h4>'+textoRespuesta+'</h4>';
							}
						}else{
							//Error "de codificación" (no encontró el nodo)
							sError = "Problemas en HTML";
						}
					}else{
						//Error en JSON
						sError = "Error al recibir la respuesta del servidor";
					}
				}catch(excep){
					sError = excep.message;
					oNodoDiv.innerHTML = '<h4>'+textoRespuesta+'</h4>';
					alert("HUBO ERROR FILL");
				}
				if (sError != "")
					alert(sError);
			}
		

	function pintaProducto(sCve){
		var objRequest = new XMLHttpRequest();
		var sURL = "control/ctrlDetProductos.php";
		var sQS = "";
		if (sCve == ""){
			alert("Faltan id a buscar");
		}else{
		 sQS = "sCve="+sCve;
			objRequest.open("POST", sURL, true);
			objRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			/*Al evento onreadystatechange se le asigna
				una función anónima*/
			objRequest.onreadystatechange=function() {
				/*Si, cuando se ejecute la llamada, queda 
					en estado 4 y status 200, es que todo 
					salió bien y puede procesar la respuesta */
				if (objRequest.readyState === 4 && 
					objRequest.status === 200) {
						ProsPinProd(objRequest.responseText);
				}
			};
			objRequest.send(sQS);
			}
		}

		function ProsPinProd(textoRespuesta){
		var oNodoDiv = document.getElementById("catalogo");
		var oDatos;
		var sError = "";
		var oCretArtc;
		var oCretAdd1,oCretAdd2,oCretAdd3,oRepl;
			/*El texto (cadena) de respuesta de la llamada se 
			  convierte al objeto equivalente JSON (objeto con
			  atributos. Se espera sSit, sNom, nTipo)*/
			try{
				oDatos = JSON.parse(textoRespuesta);
				/*Si lo pudo convertir a objeto, entonces muestra 
				  su información bajo el formulario*/
				if (oDatos !== null){
					if (oNodoDiv != null){
						if (oDatos.success){							
							oRepl=document.getElementById("container");
							oCretArtc=document.createElement("div");
							oCretArtc.id = "container";				
							oNodoDiv.className="infoProducto"
							oNodoDiv.replaceChild(oCretArtc,oRepl);

							oCretAdd2 = document.createElement("div");
							oCretAdd2.id="imagenProducto";
							oCretArtc.appendChild(oCretAdd2);

							oCretAdd3 = document.createElement("img");
							oCretAdd3.src = oDatos.oProducto.sImg;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd2 = document.createElement("div");
							oCretAdd2.id="detallesProducto";
							oCretArtc.appendChild(oCretAdd2);

							oCretAdd3 = document.createElement("h1");
							oCretAdd3.innerHTML = oDatos.oProducto.sNomProducto;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("h2");
							oCretAdd3.innerHTML = "$"+oDatos.oProducto.nPrecio+".00";
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("img");
							oCretAdd3.src = "media/tarjetas.png";
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("img");
							oCretAdd3.src = "media/auto.png";
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);
							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);
							
							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Talla: "+oDatos.oProducto.sTallas;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Tamaño: "+oDatos.oProducto.sTamanos;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Color: "+oDatos.oProducto.sColores;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Tipo: "+oDatos.oProducto.sTipo;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Equipo: "+oDatos.oProducto.sEquipo;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Disciplina: "+oDatos.oProducto.sDisciplina;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("p");
							oCretAdd3.innerHTML = "Genero: "+oDatos.oProducto.sGenero;
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3 = document.createElement("br");
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd3=document.createElement("form");
							oCretAdd3.setAttribute("action",'control/ctrlCarrito.php');
							oCretAdd3.id="infoProductoForm";
							oCretAdd3.method="GET";
							oCretAdd2.appendChild(oCretAdd3);

							oCretAdd1 = document.createElement("input");
							oCretAdd1.name = "id_prod";
							oCretAdd1.type = "text";					
							oCretAdd1.setAttribute("value",oDatos.oProducto.nCveProd);
							oCretAdd1.hidden=true;							
							oCretAdd3.appendChild(oCretAdd1);
							
							oCretAdd1 = document.createElement("input");
							oCretAdd1.name = "nombre_prod";
							oCretAdd1.type = "text";
							oCretAdd1.setAttribute("value",oDatos.oProducto.sNomProducto);
							oCretAdd1.hidden=true;							
							oCretAdd3.appendChild(oCretAdd1);

							oCretAdd1 = document.createElement("input");
							oCretAdd1.name = "precio_prod";
							oCretAdd1.type = "text";
							oCretAdd1.setAttribute("value",oDatos.oProducto.nPrecio);
							oCretAdd1.hidden=true;
							oCretAdd3.appendChild(oCretAdd1);

							oCretAdd1 = document.createElement("input");
							oCretAdd1.name = "prod_qty";
							oCretAdd1.type = "text";
							oCretAdd1.setAttribute("value",1);
							oCretAdd1.hidden=true;
							oCretAdd3.appendChild(oCretAdd1);

							oCretAdd1 = document.createElement("input");
							oCretAdd1.id = "productoMuestrasubmit";
							oCretAdd1.type = "submit";
							oCretAdd1.value = "Agregar al carrito";
							oCretAdd3.appendChild(oCretAdd1);
						}else{
							//Error "de negocio"
							sError = oDatos;
							oNodoDiv.innerHTML = '<h4>'+textoRespuesta+'</h4>';
						}
					}else{
						//Error "de codificación" (no encontró el nodo)
						sError = "Problemas en HTML";
					}
				}else{
					//Error en JSON
					sError = "Error al recibir la respuesta del servidor";
				}
			}catch(excep){
				sError = excep.message;
				oNodoDiv.innerHTML = '<h4>'+textoRespuesta+'</h4>';
				alert("HUBO ERROR JSON");
			}
			if (sError != "")
				alert(sError);
		}
			
	