$(function() {
	J_CaseBaojia();function J_CaseBaojia(){var wrap=$("#J_CaseBaojia");var resultShow=$("#resultShow i",wrap);setInterval(function(){var a=Math.ceil(Math.random()*150000)+10000;resultShow.text(a);
},200);var unit=$("#unit",wrap),unitVal=$(".unitVal",wrap),unitTxt=new Array();unit.hide().after(unitVal);unitVal.show();$(".section",unitVal).each(function(i) {
	var me=$(this),list=$(".list",me),label=list.siblings("label");unitTxt[i]=list.val()+label.text();unit.val(unitTxt.join(','));list.change(function(){var val=$(this).val()+label.text(),unitTxt=unit.val().split(",");unitTxt[i]=val;unit.val(unitTxt);
});});}});

function J_CaseBaojia_submit(f,isvcode) {
	var formId=$("#"+f),isvcode=isvcode?isvcode: 0,form=$("form",formId),btn=$("#_phpok_submit",formId),contact=$("#contact",formId),phone=$("#phone",formId),area=$("#area",formId),check=$("#sys_check",formId),imgcode=$("#imgcode",formId),yusuan=$("#yusuan",formId),resultShow=$("#resultShow",formId),hxVal=$(".hx select option:selected",formId).attr("data-num"),weiVal=$(".wei select",formId).val(),areaVal=parseFloat(area.val()),costResult;
	if(btn.hasClass("disabled")){layerAlert('您已经提交过了，感谢您的支持！',6,4000);return false;
}

if(!contact.val()&&contact.length) {
	layerTips('请输入您的称呼',contact);contact.focus();return false;
}

 

if(isNaN(areaVal)) {
	layerTips('请输入正确的面积',area);area.focus();return false;
}

costResult=1298*areaVal;var Result=parseFloat(costResult);if(isNaN(Result)) {
	layerAlert("计算失败，请检查所填写格式");return false;
}

else {
	Result=Math.round(costResult);
}

yusuan.val(Result);$.post(form.attr("action"),form.serialize(),function(data2) {
	resultShow.text(Result);btn.addClass("disabled");
});

return false;
}