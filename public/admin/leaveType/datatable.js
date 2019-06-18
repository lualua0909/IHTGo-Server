$('#leaveType').DataTable({
    "processing": true,
    "serverSide": true,
    "bAutoWidth": false,
    "responsive": true,
    "ordering": true,
    "ajax": {
      "url": '/api/leave-type/getData',
      "data": function (d) {
        
      },
      dataFilter: function (data) {
        var json = jQuery.parseJSON(data);
        
        if (json.recordsFiltered <= 0) {
          $('#example_paginate').hide();
        } else {
          $('#example_paginate').show();
        }
        if (json.recordsTotal < 10) {
          $('.paging_simple_numbers').hide();
        } else {
          $('.paging_simple_numbers').show();
        }
        return JSON.stringify(json);
      },
      error: function ($xhr) {
        console.log($xhr);
      }
    },
  
    "columns": [
        {
            "data": "stt"
        },
        {
            "data": 'name_en', render: function (data, type, row) {
              return '<a href="/admin/data/leave-type/' + row.id +'">' + data + '</a>'
            }
        },
        {
            "data": "name_vn", render: function (data, type, row) {
              return '<a href="/admin/data/leave-type/' + row.id +'">' + data + '</a>'
            }       
        },
        {
            "data": "company_code"
        },
        {
            "data": 'leave_code'
        }
    ]
});