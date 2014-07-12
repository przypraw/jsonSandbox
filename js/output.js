$.ajax({
   type: 'GET',
   url: 'storage/restaurant.json',
   dataType: 'json'
}).done(function( data, textStatus, jqXHR ) {
    
    var divKey = "<div class='col-md-3' style='font-weight:bold;'></div>";
    var divValue = "<div class='col-md-3'></div>";
    var descriptionContainer = '<blockquote></blockquote>';
    var json = data;
    console.dir(json);
    var name = json.restaurantName;
    var rating = json.rating;
    var location = json.location;
    var description = json.description;
    var forKey,forValue;
    var container = $('#container');
    if(typeof json.restaurantName === 'string'){
        forKey = $(divKey).text('Restaurant Name:');
        container.append(forKey);
        forValue = $(divValue).text(name);
        container.append(forValue);
        
        forKey = $(divKey).text('Restaurant Rating: ');
        container.append(forKey);
        forValue = $(divValue).text(rating);
        container.append(forValue);
        
        forKey = $(divKey).text('Restaurant Location: ');
        container.append(forKey);
        forValue = $(divValue).text(location);
        container.append(forValue);
        container.append('<p class="clearfix">&nbsp;</p>');
        
        forValue = $(descriptionContainer).text(description);
        container.append('<span style="font-weight: bold;color:#46b8da;">User Experience: </span>');
        container.append(forValue);
        return false;
    }
    
    

    for(var i = 0; i<rating.length;i++){
        forKey = $(divKey).text('Restaurant Name:');
        container.append(forKey);
        forValue = $(divValue).text(name[i]);
        container.append(forValue);
        
        forKey = $(divKey).text('Restaurant Rating: ');
        container.append(forKey);
        forValue = $(divValue).text(rating[i]);
        container.append(forValue);
        
        forKey = $(divKey).text('Restaurant Location: ');
        container.append(forKey);
        forValue = $(divValue).text(location[i]);
        container.append(forValue);
        container.append('<p class="clearfix">&nbsp;</p>');
        
        forValue = $(descriptionContainer).text(description[i]);
        container.append('<span style="font-weight: bold;color:#46b8da;">User Experience: </span>');
        container.append(forValue);
        
        
    }
    
    

    
    
    console.dir(data);
    console.dir(textStatus);
    console.dir(jqXHR);
}).fail(function( jqXHR, textStatus, errorThrown ) {
    console.dir(errorThrown);
    console.dir(textStatus);
    console.dir(jqXHR);
    var container = $("#container");
    var fail = "<h2 class='bg-danger'>No Restaurants have been found!</h2>"; 
    container.append(fail);
});;