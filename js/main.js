const $armor = $('#box-armor').clone();

var colArmor = 1;

	$('#add-user-armor').click(function(){
		if(colArmor < 3){
			colArmor ++;
			$armor.find( "span" ).text('Броня '+colArmor)
			$armor.attr('name', 'user-armor-'+colArmor);
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
			$gunMain.attr('name', 'user-main-gun-'+colGunMain);
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