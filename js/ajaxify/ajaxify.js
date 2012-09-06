var SpAjaxify = new Class.create();
SpAjaxify.prototype = {
  initialize: function(url, params) {
    this.url = url;
    this.params = params;
    this.updateElementId = null;
    this.messageUrl = SP_AJAXIFY_MESSAGE_URL;
    
    this.messageContainerId = 'sp_ajaxify_message';
    this.loaderId = 'sp-loading';
    
  },
  
  request: function() {
    this._requestAjax();
  },
  
  requestUpdate : function (updateElementId) {
  	if (!$(updateElementId)) {
  		alert('Element to update after request not found.');
  		return false;
  	}
  	this.updateElementId = updateElementId;
  	this._requestUpdateAjax();
  },
  
  _requestAjax: function () {
  	 this._showLoader();
 	 new Ajax.Request(this.url,{
            method: 'get',
            parameters: this.params,
            onComplete: this._processAjaxSuccess.bind(this),
            onFailure: this._processAjaxFailure.bind(this),
     });
  },
  
  _requestUpdateAjax : function () {
  	this._showLoader();
  	new Ajax.Updater(this.updateElementId, this.url , {
	  parameters: this.params,
	  onComplete: this._processAjaxSuccess.bind(this),
      onFailure: this._processAjaxFailure.bind(this),
	});
  
  },
  
  /* This will do another request to the message URL and get the message set during the 
  	 previous Ajax request. 
  */
  _showMessage : function () {
 	 new Ajax.Request(this.messageUrl,{
            method: 'get',
            parameters: '',
            onComplete: this._fillMessageText.bind(this),
            onFailure: this._processAjaxFailure.bind(this),
     });
  	
  },
  
  _showLoader: function () {
  	$(this.loaderId).style.display = 'block';
  },
  
  _hideLoader: function () {
  	$(this.loaderId).style.display = 'none';
  },
  
  _fillMessageText : function (transport) {
  	var messageHtml = transport.responseText;
  	if (messageHtml == '') {
  		return;
  	}
  	if ($(this.messageContainerId)) {
  		$(this.messageContainerId).innerHTML = messageHtml;
  		Effect.SlideDown(this.messageContainerId + '_container', { duration: 0.5 });
  	} else {
  		alert(messageHtml);
  	} 
	return;
  },
  
  _processAjaxSuccess : function (transport) {
  		 this._showMessage();
  		 this._hideLoader();
  },
  
  _processAjaxFailure : function(transport){
  		this._hideLoader();
        alert('Error during AJAX request');
        return false;
  },

}
