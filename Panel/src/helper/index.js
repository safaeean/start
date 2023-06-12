const myPlugin = {
  install(app) {
    app.config.globalProperties.$httpPost = function (prefix, prop, data, callback, always_put = false) {
      fetch(prefix + (prop ? `/${prop}` : ""), {
        method: prop || always_put ? "PUT" : "POST",
        headers: {
          "Content-Type": "application/json",
          // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: JSON.stringify(data)
      })
        .then(function (response) {
          if (response.status != 200) {
            throw response.status;
          } else {
            return response.json();
          }
        }).then(function (data) {
          callback(data)
        }
      );
    },
    app.config.globalProperties.$httpGet = function (url, callback, query = {}) {
      console.log(query)
      return fetch(url + '?' + (new URLSearchParams(query)).toString(), {
        method: 'GET'
      })
        .then(function (response) {
          if (response.status !== 200) {
            throw response.status;
          } else {
            return response.json();
          }
        }).then((data) => {
          callback(data)
        })
    }
  }
}

export default myPlugin;
