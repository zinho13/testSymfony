// $(document).ready(function() {
//     /**
//      * 
//      * 
//      */

//     // $("path.region").on({
//     //     mouseenter: (e) => {
//     //         $("#" + e['target'].id).attr("fill", "#c96d6d")
//     //     },
//     //     mouseleave: (e) => {
//     //         $("#" + e['target'].id).attr("fill", "#7c7c7c")
//     //     }
//     // });

//     $("path.region").click((e) => {
//         var region_id = "#" + e['target'].id
//         $("path.region").attr("fill", "#7c7c7c")
//         $(region_id).attr("fill", "#d31b1b")
//     })

// });

/**
 * 
 * 
 */
var el = document.getElementsByTagName('path')
for (let e of el) {
    e.onclick = () => {
        document.querySelector("path.active").classList.remove("active")
        e.classList.add("active")
    }
}