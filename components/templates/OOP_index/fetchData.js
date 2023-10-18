$(function () {
    // ...（以前のコードをここに配置）
  
    // APIエンドポイント
    const apiUrl = 'https://raquty.com/data/functions.php';
  
    

    function fetchStaticData() {
      // 非同期通信を行うコードを記述
      // ここでAPIリクエストなどを行う
      // 例: fetch APIを使用した場合
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          const event = new CustomEvent('staticDataUpdated',  {detail: data});
          document.dispatchEvent(event);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }
    function fetchDynamicData() {
      // 非同期通信を行うコードを記述
      // ここでAPIリクエストなどを行う
      // 例: fetch APIを使用した場合
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          const event = new CustomEvent('dynamicDataUpdated',  {detail: data});
          document.dispatchEvent(event);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }
    
    // 初回の静的データ取得
    fetchStaticData();
    // 初回の動的データ取得
    fetchDynamicData();
    // 50000ミリ秒(5min)ごとに静的データを取得する
    setInterval(fetchStaticData, 50000);
    // 5000ミリ秒(5sec)ごとに動的データを取得する
    setInterval(fetchDynamicData, 5000);
  });
  
  