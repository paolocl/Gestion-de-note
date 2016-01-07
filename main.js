/**
 * Created by wap26 on 23/12/15.
 */
$(document).ready(function(){
    $(function() {
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true
        });
    });
    $(function() {
        $( ".accordion" ).accordion({
            active: false,
            collapsible: true
        });
    });
    $( "#accordionEleve" ).accordion({
        header: ".eleve",
        icons: false,
        heightStyle: "content",
        active: false,
        collapsible: true
    });
});