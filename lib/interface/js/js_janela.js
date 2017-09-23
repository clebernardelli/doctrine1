function telapadraoEx(sAOwner, bScroll){
  var divTela = document.getElementById(sAOwner);
  var divModal = document.createElement("div");

  divModal.className = "tela_fundo_modal_padrao";
  divModal.style.display = "none";
  divTela.appendChild(divModal);

  var tela = document.createElement("div");
  divTela.appendChild(tela);
  
  var lugar_texto = document.createElement("div");

  var topo = document.createElement("div");// topo
  topo.className = "topo_tela_padrao";
  topo.style.cursor = "move";
  tela.appendChild(topo);// tela principal
  
  var btnFechar = document.createElement("div");
  topo.appendChild(btnFechar);
  btnFechar.className = "botao_fechar_tela";
  
  tela.className = "tela_cadastro_padrao_modal";
  
  var texto_topo = document.createElement("div");
  texto_topo.className = "topo_caption_padrao";
  topo.appendChild(texto_topo);

  tela.style.visibility = "hidden";
  tela.modalresult = NENHUM;

	this.nome = "";
  this.id = "";
  this.ICON = NENHUM;
  this.modal = false;
  this.caption = "";
  this.buttons = [];
  this.botaopadrao = 0;
  var botao_foco = null;
  this.mensagem = "";
  this.height = "";
  this.width = "";
  this.top = "";
  this.left = "";

	if (bScroll == undefined)
		bScroll = true;

  if (bScroll)
		Drag.init(topo, tela);// para poder usar o drag-and-drop

  this.sair = function (modalresult_){}

  this.close = function (){
				 tela.modalresult = NENHUM;
				 sair();
				 return false;
			   }

  var evento_ao_sair;

  var sair = function (){
			   var modalresult_ = tela.modalresult;
			   divTela.removeChild(divModal);
			   divTela.removeChild(tela);
			   evento_ao_sair(modalresult_);
			 }
			  
  btnFechar.onclick = function() {
						tela.modalresult = NENHUM;
						sair();
						return false;
					}
  
  this.botao_ok = function(){
					tela.modalresult = OK;
					sair();
					return true;
				  } 

  this.botao_sim = function(){
					 tela.modalresult = SIM;
					 sair(); 
					 return true;
				   } 

  this.botao_nao = function(){
					 tela.modalresult = NAO;
					 sair();
					 return false;
				   }

  this.botao_cancelar = function(){
						  tela.modalresult = CANCELAR;
						  sair();
						  return false;
						} 

  this.HTML_padrao_mensagem = function () {//HTML padrão pra quando a tela tiver mensagens
  
sRet =
 
"  <table border='0'> \r\n" +
"  <tr> <td height=5'></td> </tr> \r\n" +
"  <tr> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    <td id='local_imagem_" + this.id + "'></td> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    <td class='active_msg' align='left'> \r\n" +
"    <div id='div_mensagem_" + this.id + "' align='justify'></div> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    <td>&nbsp;</td> \r\n" +
"    </td> \r\n" +
"  </tr> \r\n" +
"    <tr>&nbsp;</tr> \r\n" +
"  </table> \r\n" +
"  <table align='center' border='0'> \r\n" +
"  <tr id='local_botoes_" + this.id + "'> \r\n" +// neste local vai criar os botoes
"  </tr> \r\n" +
"  </table> \r\n" +
"  <table width='200' border='0'> \r\n" +
"    <td height='6'></td> \r\n" +
"  </table>\r\n";

return sRet;
}

	this.innerHTML = function (sHtml){
		lugar_texto.innerHTML = sHtml;
	}

  this.montaBotoes = function(){
					   if (this.buttons.length == 0) return false;
					   
					   var local_botoes = document.getElementById("local_botoes_" + this.id);

				       for (var i=0;i<this.buttons.length;i++){
					   	
					  	 var td = document.createElement("td");
						 td.style.align = "center";
						 local_botoes.appendChild(td);
						 
						 var botao = document.createElement("input");
						 botao.type = "button";
						 botao.className = "botao_msg";
						 botao.setAttribute("owner", this);
						 
						 if (i == (this.botaopadrao-1)){
						   botao_foco = botao;
						 }  
						 
						 if (this.buttons[i] == OK){
						   botao.value = "OK";
						   botao.onclick = this.botao_ok;
						   
						 } else if (this.buttons[i] == SIM) {
						   botao.value = "Sim";
						   botao.onclick = this.botao_sim;
						   
						 } else if (this.buttons[i] == NAO) { 
						     botao.value = "Não";
						     botao.onclick = this.botao_nao;
							 
						 } else if (this.buttons[i] == CANCELAR) {
						     botao.value = "Cancelar";
						     botao.onclick = this.botao_cancelar;
                         }
						  
						 td.appendChild(botao);
					   }
                     }
					 
  this.montaTexto = function (){
				      if (this.mensagem != "") { 
					    var local_texto = document.getElementById("div_mensagem_" + this.id);
					    local_texto.innerHTML = this.mensagem;
					  }
                    }
					
  this.montaIcone = function (){
					  if (this.ICON == NENHUM) return false;

					  var local_imagem = document.getElementById("local_imagem_" + this.id);

					  if (this.ICON == ERRO){

						var imagem = document.createElement("img");
						imagem.src = "estilos/VistaInspirate/32/status/dialog-error.png"; 
						local_imagem.appendChild(imagem);

					  } else if (this.ICON == INFORMACAO){

						var imagem = document.createElement("img");
						imagem.src = "estilos/VistaInspirate/32/status/dialog-information.png"; 
						local_imagem.appendChild(imagem);

					  } else if (this.ICON == PERGUNTA){

						var imagem = document.createElement("img");
						imagem.src = "estilos/VistaInspirate/32/status/dialog-question.png"; 
						local_imagem.appendChild(imagem);

					  } else if (this.ICON == ATENCAO){

						var imagem = document.createElement("img");
						imagem.src = "estilos/VistaInspirate/32/status/dialog-warning.png"; 
						local_imagem.appendChild(imagem);
					  } 	
					}
					
  this.resize = function (){
				  tela.id = this.id;
				  this.nome = this.id;
				  topo.id = "div_topo_" + this.id; 
				  // todos os name da tela joga o nome da tela tbem para nuncar ficar com nome repetidos

				  texto_topo.innerHTML = this.caption;
				  tela.style.width = this.width;
				  tela.style.height = this.height;
				  tela.style.left = this.left;
				  tela.style.top = this.top;
				  
                } 

  this.show = function (){

				if (this.modal == true)
				  divModal.style.display = "";
				 
				tela.appendChild(lugar_texto);
				lugar_texto.innerHTML = this.HTML_padrao_mensagem();
				  
				this.montaTexto();
				this.montaBotoes();
				this.montaIcone();
				  
				this.resize();
				
				tela.style.visibility = "visible";
								if (botao_foco!=null)// setando o foco no botao padrao
				  botao_foco.focus();

				evento_ao_sair = this.sair;

	}
}

function ShowMsg(sMensagem, ICON, sDivPai, evento_sair) {

	this.caption = sMensagem;

	if (sDivPai == undefined)
	sDivPai = "divTela";

	if (sDivPai == "")
		sDivPai = "divTela";

  this.tela = new telapadraoEx(sDivPai);
  this.tela.caption = "UnosoftWeb";
  this.tela.id = "tela_mensagem";
  this.tela.mensagem = sMensagem;

  this.tela.top = "230"; 
  this.tela.left = "250";
  this.tela.width = 400;

  this.tela.modal = true;
  this.tela.buttons = [OK];
  this.tela.botaopadrao = 1;
  this.tela.ICON = ICON;

  if (evento_sair!=undefined)
    this.tela.sair=evento_sair;

  if (ICON == undefined) 
    this.tela.ICON = INFORMACAO;
	
  this.tela.show();

}


var divAguarde = null;


function Aguarde(sMsg){

	if (sMsg == ""){
		if (divAguarde != null){
			var divCont = document.getElementById("divCont");
			divCont.removeChild(divAguarde);
			divAguarde = null;
		}

	} else {
		if (divAguarde == null){
			divAguarde = document.createElement("div");

			var sHtml = "<img src='img/roda.gif'></img>";
//			var sHtml = "<img width='130' height='100' src='img/roda.gif'></img>";
			divAguarde.innerHTML = sHtml;//sMsg;

			divAguarde.style.position = "absolute";
			//divAguarde.style.width = 100;
			//divAguarde.style.height = 100;

			divAguarde.style.top = "40%";
			divAguarde.style.left = "40%";

			divAguarde.style.zIndex = 1;
//			divAguarde.style.background = "#FF8A8A";

			var divCont = document.getElementById("divCont");
			divCont.appendChild(divAguarde);

		} else
			divAguarde.innerHTML = sMsg;
	}
}

