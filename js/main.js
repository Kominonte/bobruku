const $armor = $('#box-armor').clone();

var colArmor = 1;

	$('#add-user-armor').click(function(){
		if(colArmor < 3){
			console.log($armor);
			colArmor ++;
			$armor.find( "span" ).text('Броня '+colArmor)
			$armor.find("select").attr('name', 'user-armor-'+colArmor);
		 	$(this).before($armor.clone());
	 	}else{
			false;
		}
	});

const $gunMain = $('#box-main-gun').clone();

var colGunMain = 1;


	$('#add-user-main-gun').click(function(){
		if(colGunMain < 5){
			colGunMain ++;
			$gunMain.find( "span" ).text('Основное оружие '+colGunMain)
			$gunMain.find("select").attr('name', 'user-main-gun-'+colGunMain);
		 	$(this).before($gunMain.clone());
	 	}else{
			false;
		}
	});


const $gunSecon = $('#box-second-gun').clone();

var colGunSecond = 1;


	$('#add-user-second-gun').click(function(){
		if(colGunSecond < 3){
			colGunSecond ++;
			console.log(colGunSecond);
			console.log($gunSecon);
			$gunSecon.find( "span" ).text('Вторичное оружие '+colGunSecond)
			$gunSecon.attr('name', 'user-second-gun-'+colGunSecond);
		 	$(this).before($gunSecon.clone());
	 	}else{
			false;
		}
	});


function viewHooky(){
 	document.getElementById("background-dark").style.display = "block";
	document.getElementById("hooky-add-box").style.display = "block";
	document.getElementById("body").style.overflow = "hidden";
};

function closeHooky(){
 	document.getElementById("background-dark").style.display = "none";
	document.getElementById("hooky-add-box").style.display = "none";
	document.getElementById("body").style.overflow = "visible";
};

function viewSquaList(){
	let squaList = arguments[0]; 
	document.getElementById("squad-user-position-list-"+squaList).style.display = "block";
	document.getElementById("close-list-"+squaList).style.display = "block";
}

function closeSquaList(){
	let squaList = arguments[0]; 
	document.getElementById("squad-user-position-list-"+squaList).style.display = "none";
	document.getElementById("close-list-"+squaList).style.display = "none";
}

function viewSquadSetting(){
	let squaSettingOp = arguments[0];
	document.getElementById("squad-setting-"+squaSettingOp).style.display = "block";
	document.getElementById("close-setting-"+squaSettingOp).style.display = "block";
	document.getElementById("open-setting-"+squaSettingOp).style.display = "none";
	document.getElementById("squad-list-"+squaSettingOp).style.borderRadius = "10px 10px 0px 0px";
}
function closeSquadSetting(){
	let squaSettingCl = arguments[0];
	document.getElementById("squad-setting-"+squaSettingCl).style.display = "none";
	document.getElementById("close-setting-"+squaSettingCl).style.display = "none";
	document.getElementById("open-setting-"+squaSettingCl).style.display = "block";
	document.getElementById("squad-list-"+squaSettingCl).style.borderRadius = "10px 10px 10px 10px";
}

function viewAddSquad(){
	document.getElementById("squad-add").style.display = "block";
	document.getElementById("background-dark").style.display = "block";
}

function closeAddSquad(){
	document.getElementById("squad-add").style.display = "none";
	document.getElementById("background-dark").style.display = "none";
}

function viewGun(){
	let changeGun = arguments[0];
 	document.getElementById("background-dark").style.display = "block";
	document.getElementById("change-user-gun-box-number-"+changeGun).style.display = "block";
	document.getElementById("body").style.overflow = "hidden";
};

function viewArmor(){
	let changeArmor = arguments[0];
 	document.getElementById("background-dark").style.display = "block";
	document.getElementById("change-user-armor-box-number-"+changeArmor).style.display = "block";
	document.getElementById("body").style.overflow = "hidden";
};



function closeHooky(){
 	document.getElementById("background-dark").style.display = "none";
	document.getElementById("hooky-add-box").style.display = "none";
	document.getElementById("body").style.overflow = "visible";
};
