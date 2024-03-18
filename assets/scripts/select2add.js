function initializeSelect2(selectElementObj) {
  selectElementObj.select2({
    // width: "80%",
    // tags: true,
    // language:"id",
    // ajax: {
    //     url: "https://cdn.jsdelivr.net/npm/world_countries_lists@latest/data/en/countries.jsons",
    //     dataType: "json",
    //     type:"GET",
    //     delay: 250,
    //     data: function (params) {
    //         return {
    //             search: params.term
    //         }
    //     },
    //     processResults: function (data) {
    //         return {
    //             results: $.map(data, function (item) {
    //               return {
    //                 id:item.id,
    //                 text:item.name
    //               }
    //             })
    //         };
    //     },
    //     cache: false
    // },
    // minimumInputLength: 3,
    // dropdownParent:$("#add_prosesmnf")

    placeholder: "Select a state",
    width:"100%"

  });
};

$("#kat_brg").each(function() {
  initializeSelect2($(this));
});

$("#grp_brg").each(function() {
  initializeSelect2($(this));
});

// $("#kategori-filter").each(function() {
//   initializeSelect2($(this));
// });

// $("#subkategori_filter").each(function() {
//   initializeSelect2($(this));
// });

$("#gud").each(function() {
  initializeSelect2($(this));
});

$("#kat_brg_mnf").each(function() {
  initializeSelect2($(this));
});

$("#kat_brg_bb").each(function() {
  initializeSelect2($(this));
});

$("#gud_prod").each(function() {
  initializeSelect2($(this));
});