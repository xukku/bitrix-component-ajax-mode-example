
// пример кастомизации индикации - заменить реализацию bitrix js методов

(function () {

	var lastWait = [];

	function _adjustWait()
	{
		if (!this.bxmsg) return;

		var arContainerPos = BX.pos(this),
			div_top = arContainerPos.top;

		if (div_top < BX.GetDocElement().scrollTop)
			div_top = BX.GetDocElement().scrollTop + 5;

		this.bxmsg.style.top = (div_top + 5) + 'px';

		if (this == BX.GetDocElement())
		{
			this.bxmsg.style.right = '5px';
		}
		else
		{
			this.bxmsg.style.left = (arContainerPos.right - this.bxmsg.offsetWidth - 5) + 'px';
		}
	}

	window.BX.showWait = function (node, msg)
	{
		node = BX(node) || document.body || document.documentElement;
		msg = '';

		var container_id = node.id || Math.random();

		var obMsg = node.bxmsg = document.body.appendChild(BX.create('DIV', {
			props: {
				id: 'wait_' + container_id
			},
			style: {
				background: 'url("/local/assets/images/wait.gif") no-repeat scroll center',
				padding: '10px 30px 10px 37px',
				width: '32px',
				height: '32px',
				position: 'absolute',
				zIndex:'10000',
				textAlign:'center'
			},
			text: msg
		}));

		setTimeout(BX.delegate(_adjustWait, node), 10);

		lastWait[lastWait.length] = obMsg;

		return obMsg;
	};

	window.BX.closeWait = function (node, obMsg)
	{
		if(node && !obMsg)
			obMsg = node.bxmsg;
		if(node && !obMsg && BX.hasClass(node, 'bx-core-waitwindow'))
			obMsg = node;
		if(node && !obMsg)
			obMsg = BX('wait_' + node.id);
		if(!obMsg)
			obMsg = lastWait.pop();

		if (obMsg && obMsg.parentNode)
		{
			for (var i=0,len=lastWait.length;i<len;i++)
			{
				if (obMsg == lastWait[i])
				{
					lastWait = BX.util.deleteFromArray(lastWait, i);
					break;
				}
			}

			obMsg.parentNode.removeChild(obMsg);
			if (node) node.bxmsg = null;
			BX.cleanNode(obMsg, true);
		}
	};

})();