<style>
    #sidebar {
        margin-left: -4px;
        position: absolute;
        width: 100%;
        left: -100%;
        transition: .4s;
    }

    .van-overlay {
        visibility: hidden;
        z-index: -1;
        transition: .4s;
        opacity: 0;
    }
</style>

<div data-v-a386f8f2="" class="my_index">
    <div class="van-overlay" style="" onclick="closeSideBar()"></div>
    <div data-v-a386f8f2="" class="van-popup van-popup--left"
         style="height: 100%; width: 80%; background: unset; z-index: 2008;" onclick="openSideBar()">
        <div data-v-a386f8f2="" class="popup_box" id="sidebar">
            <div data-v-a2a35538="" data-v-a386f8f2="" class="my">
                <div data-v-a2a35538="" class="container">
                    <div data-v-a2a35538="" class="heads">
                        <div data-v-a2a35538="" class="db">
                            <div data-v-a2a35538="" class="ico"><img data-v-a2a35538=""
                                                                     src="{{asset(setting('logo'))}}">
                            </div>
                            <div data-v-a2a35538="" class="flexs">
                                <div data-v-a2a35538="" class="n">{{auth()->user()->phone}}</div>
                                <div data-v-a2a35538="" class="cid"> ID: {{auth()->user()->ref_id}}</div>
                            </div>
                            <div data-v-a2a35538="" class="arr"><img data-v-a2a35538=""
                                                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII=">
                            </div>
                        </div>
                    </div>
                    <div data-v-a2a35538="" class="level-box">
                        <div data-v-a2a35538="" class="ico"><img data-v-a2a35538=""
                                                                 src="{{asset('public')}}/static/img/vip1.bd67ca1f.png">
                        </div>
                        <div data-v-a2a35538="" class="flex1">
                            <div data-v-a2a35538="" class="name">Currently opening the highest discount channel：
                            </div>
                            <div data-v-a2a35538="" class="link">
                                <div data-v-a2a35538="" class="n">
                                    <?php
                                        $funds = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->count();
                                    ?>
                                    {{$funds}} Total Funding
                                </div>
                                <div data-v-a2a35538="" class="s">
                                    <img data-v-a2a35538="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII=">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-v-a2a35538="" class="line">
                        <ul data-v-a2a35538="">
                            <li data-v-a2a35538="" class="db" onclick="window.location.href='{{route('user.bank')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQPSURBVHgB7ZhPbNtUGMC/z34JK+FPIrUu2bJhc4WgrOHQ3jq1Et1l7S4cWSoBJyQ6JDSJP4feuKCBuI2ipgdA4tIOLkMaUrgNaYVeuC7ehFa1IGoE2Ubq+OM9p27c1q/1a+NomvaTEj/H79m/vH9+7wN4yEFIiPrqfZMBM1FH0yNw0CPHfcBWLAsdlft0VfD39WaJPKxoTJsEAjMyE4HNv2vNVnPWyvfZB91TKlganhjVkKaQ8FmIQTaXy5aHylP75XmpWIRi8WUwDCOQrR4kihFipg4wz5OjkADG4CCcOzfpf7Yk7RbRxVODbAniCJZHXv0VCEvtwugQ0t8gYdAwnoeYNBoN/xPwxptvdST9R1Gl0M8WYD/B8sjZKSBa3DpdePrYg5larRbZqe+suVO6hougwI/Xr8Pc3BVfNJPJwNyX8/4xwHO9MyfzqVq4jBY+oaBZiZzlG9cqMrnVVTIZapdBkbHxcXj/g4/8tJAUwjtkmLZY36Bs+DcWPkHqXCwPT8zLHvTeh++Wjj93woQj8t33VyHzVCY8cLLpTU/88eltp3ABLlXlhwvQY3YPHPqvdbpQSK+INJMV4s19O+p3lYFxEMHAWV9bg7kvrvi/CUlKY4UnZ6SCXM7+5cY1K+ra3XWvzkecCV0iPHC++forGBsbh8yTmclAUFO5mejA3ZQTRA4cBFO8KpUFmeuWIAGK/A0TTDf1+q32s/h7XByVBAkxCwkRng/9Z+ntllIS1DxITHAPpPlzsGINkg09QizPxFGxDzIbeoR7jPnzoJJgPo82SObHroJgWzlUr0EBkbcEyVMLEgyUoSr/ekelxB8bLfj8Wwd+u9UE63gKLr2eg4GcLs3f1JuzQVq5BgtGeoWIFlTKfLzwly8nqN/d9GVlLC/fvGrlOitsZUHBZkoXr6HYmx971d1xHshG4TjORvj8UIKiA3vgnY+b/8UX0jvOzXwK4nIoQcHJgVSNN/V0nLxvv5blUu3uLmQvXcjtyXOvcS+yRQ4xSDoUDFa986frMNAuc1lTls/gA+KTmYHoiwiOR975fxr/VvnidM+b6tA1GHCqny3xzfkZ1YGzJVdt6polWkOW5ciCgnwObV6bYsNuCVFEf0KXcZvX2GdErdMn+vXpYEKWcaQmjhLlh4pIi7WjWJ6JFZBYZIj3uOu6dpxoQmKCYbZqpgZHpCtNnCSRguHtZ6+QxYB2btwJV9q5MfsKDx5BjxganqhwQ79S+IbtJ5AJen1PVEU8xs/IQyB+wYQRUTT+zCBKYad39ds9waOhkbMzvIm3wxokhJGUgo6xIcwidroTf+7Fmz//8CnsJxiSFEsqE3oBrwQEb3a3nEAawBzmcUK+5hjFhOKE22683z/Td78qC1Q95pHnfwWTi1fqtjLIAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Withdraw Account</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db" onclick="window.location.href='{{route('my.fund')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAT5SURBVHgB7ZjPbxtFFMffrDdO0gQpkVpHqdKy6woFlJhaKWocIRSHBJEIpLiCUrg0DuWe9IZ6wDZ3lPQvwLlQ0QuJQCIVh2wlJJwqSU3tHmtvUUREhBQLZGE79g5v1r/Wv3f9A/XAVxrv7Ozu7MdvZ968eQAvuAh0SNGjfwQeeIGYiKBQiBGFxtIJPiiKJGakn7YC3v9ux/7K6KjbYhlaBApC1ZsoyPgrpTIpnzjcKzfqsyVAu9M5AIkeF0eoHTuaBkrsrN1qtcL4uA1sttdBxLrFYoEasP5GoIYA7Y55gaPERQi9TAGc+LCg5znL0BDYEHjcZgOraFWhNZByhtLbF4f4TTACmLOOHYHQOso0Bc6JYAPQBvX19aF1baqVrdZLKjgl1D1ylt8APYATkwurePA0AmIvEtEi7JNOOhzqy5gikWcQDoUghCUcDkEjMQvPzs7Bjesfz1wY7pLqAk445j3Y6K3aE2UzkD4cfe1V+ebNpRU2xvQoFHoC0UikAByPx6ve98GH12Of3PpUFAeLM70EkI0xE3qIEiBCt3C8SWYsgcC2zJoP/0j7CUeWoEkxC0cjUQiFn6iWPj4+Llz7au2u3zk1upw/57UPcgBuDdzm/u6P18o7PzqigsIpTcMxsaHAyuzcnHp+587nKijT3qNd9+Fh6u7IiDmYYypKOytx0G5V6zzDZbzQZs2+PVuoM2tSM3HnzzkwKI5w09BhccAtFusGFD2hA2hZATotAgJbKlnVECCfTtvhPxJbx9nRECAlpC2OWte7TNkvxRt5iFNgoNba88PPcbj/099q/f23+uGjuX5oSZRTfaFBC1K5Wvujpwn4+vu/IJ6gavkWQZ9GUtCKWHhmGJBP83K19ujvpxVt4WdJaEXpHr7SDzbS8DCR8fC8vH3M2l1xr3i+C5oWATm/3Bn2g5QqFWHR+CUzvPfmmcL5jXf64epYD7QgKV8xDIiI/mqtV8d6C/UxqxlaUcqU8uXrhgFHLOYgpXQDOqT9/b0tcbAYYZcAop8rbmgwjK/VyWmXicWLhjY/9RSNFgOok1gsqL1WHixIhToll6GG2ABWQLkGbVIg8EuRQVFqA2a6u6VsUKrK+YZj3lmjT7hwrkvCT12I28TzPJwbNOWKfv9fHg9mzqQk7fXKiHpqYZ1QupI7lfYD2zNQR7/9mXbxwK0hrABN6LNby1pAP75vWXu9YpKYKV3XWnFi8t01qKOLZ/lN3JzPNDNx7t37psR66Dl95fdU3zRNLayiFQtgGPJ7DwLbPmigoxMqZE4zXo7jputY9LmCvvRLzxcvHzx+7NKA+PYC215dgExXHPM7eHAahcyLxY4sPGMREAsy2DqeTqdltkmv2JjV2F7UBbQ7XQOmZHIHl46Cu0GrrB/sPrgNTYrttblkrwe/zmoBgNBgf3dyRpKkmCHAmpAAsgIwE8zt8HTDoUcwERw2ufSIHriGgHldwZkNxZmdB/UjqK8RaDWr5bTxUk9itR6cbkAmdeIo4AFNtoFZE7KgG+WgKliiZwUttlqSoUAPgakU397ug3U97zWUPHLgxv6UAFoTFrXtNLvB31SybkLAbJcLFG6pPHWCf+ghhhHugIHh0VT6DWehGx/0gM7sFkrG+5fRjUhgUC3lBxuBMovhwY/uyQ9Nqi0ZVrZm02zaZImNMfR5v+IS5W3GYh2VEycGK/C/XiD9C/LgA2l9HFiOAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">My Fund</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('deposit.history')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQPSURBVHgB7ZhPbNtUGMC/z34JK+FPIrUu2bJhc4WgrOHQ3jq1Et1l7S4cWSoBJyQ6JDSJP4feuKCBuI2ipgdA4tIOLkMaUrgNaYVeuC7ehFa1IGoE2Ubq+OM9p27c1q/1a+NomvaTEj/H79m/vH9+7wN4yEFIiPrqfZMBM1FH0yNw0CPHfcBWLAsdlft0VfD39WaJPKxoTJsEAjMyE4HNv2vNVnPWyvfZB91TKlganhjVkKaQ8FmIQTaXy5aHylP75XmpWIRi8WUwDCOQrR4kihFipg4wz5OjkADG4CCcOzfpf7Yk7RbRxVODbAniCJZHXv0VCEvtwugQ0t8gYdAwnoeYNBoN/xPwxptvdST9R1Gl0M8WYD/B8sjZKSBa3DpdePrYg5larRbZqe+suVO6hougwI/Xr8Pc3BVfNJPJwNyX8/4xwHO9MyfzqVq4jBY+oaBZiZzlG9cqMrnVVTIZapdBkbHxcXj/g4/8tJAUwjtkmLZY36Bs+DcWPkHqXCwPT8zLHvTeh++Wjj93woQj8t33VyHzVCY8cLLpTU/88eltp3ABLlXlhwvQY3YPHPqvdbpQSK+INJMV4s19O+p3lYFxEMHAWV9bg7kvrvi/CUlKY4UnZ6SCXM7+5cY1K+ra3XWvzkecCV0iPHC++forGBsbh8yTmclAUFO5mejA3ZQTRA4cBFO8KpUFmeuWIAGK/A0TTDf1+q32s/h7XByVBAkxCwkRng/9Z+ntllIS1DxITHAPpPlzsGINkg09QizPxFGxDzIbeoR7jPnzoJJgPo82SObHroJgWzlUr0EBkbcEyVMLEgyUoSr/ekelxB8bLfj8Wwd+u9UE63gKLr2eg4GcLs3f1JuzQVq5BgtGeoWIFlTKfLzwly8nqN/d9GVlLC/fvGrlOitsZUHBZkoXr6HYmx971d1xHshG4TjORvj8UIKiA3vgnY+b/8UX0jvOzXwK4nIoQcHJgVSNN/V0nLxvv5blUu3uLmQvXcjtyXOvcS+yRQ4xSDoUDFa986frMNAuc1lTls/gA+KTmYHoiwiOR975fxr/VvnidM+b6tA1GHCqny3xzfkZ1YGzJVdt6polWkOW5ciCgnwObV6bYsNuCVFEf0KXcZvX2GdErdMn+vXpYEKWcaQmjhLlh4pIi7WjWJ6JFZBYZIj3uOu6dpxoQmKCYbZqpgZHpCtNnCSRguHtZ6+QxYB2btwJV9q5MfsKDx5BjxganqhwQ79S+IbtJ5AJen1PVEU8xs/IQyB+wYQRUTT+zCBKYad39ds9waOhkbMzvIm3wxokhJGUgo6xIcwidroTf+7Fmz//8CnsJxiSFEsqE3oBrwQEb3a3nEAawBzmcUK+5hjFhOKE22683z/Td78qC1Q95pHnfwWTi1fqtjLIAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Recharge Record</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('withdraw.history')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQPSURBVHgB7ZhPbNtUGMC/z34JK+FPIrUu2bJhc4WgrOHQ3jq1Et1l7S4cWSoBJyQ6JDSJP4feuKCBuI2ipgdA4tIOLkMaUrgNaYVeuC7ehFa1IGoE2Ubq+OM9p27c1q/1a+NomvaTEj/H79m/vH9+7wN4yEFIiPrqfZMBM1FH0yNw0CPHfcBWLAsdlft0VfD39WaJPKxoTJsEAjMyE4HNv2vNVnPWyvfZB91TKlganhjVkKaQ8FmIQTaXy5aHylP75XmpWIRi8WUwDCOQrR4kihFipg4wz5OjkADG4CCcOzfpf7Yk7RbRxVODbAniCJZHXv0VCEvtwugQ0t8gYdAwnoeYNBoN/xPwxptvdST9R1Gl0M8WYD/B8sjZKSBa3DpdePrYg5larRbZqe+suVO6hougwI/Xr8Pc3BVfNJPJwNyX8/4xwHO9MyfzqVq4jBY+oaBZiZzlG9cqMrnVVTIZapdBkbHxcXj/g4/8tJAUwjtkmLZY36Bs+DcWPkHqXCwPT8zLHvTeh++Wjj93woQj8t33VyHzVCY8cLLpTU/88eltp3ABLlXlhwvQY3YPHPqvdbpQSK+INJMV4s19O+p3lYFxEMHAWV9bg7kvrvi/CUlKY4UnZ6SCXM7+5cY1K+ra3XWvzkecCV0iPHC++forGBsbh8yTmclAUFO5mejA3ZQTRA4cBFO8KpUFmeuWIAGK/A0TTDf1+q32s/h7XByVBAkxCwkRng/9Z+ntllIS1DxITHAPpPlzsGINkg09QizPxFGxDzIbeoR7jPnzoJJgPo82SObHroJgWzlUr0EBkbcEyVMLEgyUoSr/ekelxB8bLfj8Wwd+u9UE63gKLr2eg4GcLs3f1JuzQVq5BgtGeoWIFlTKfLzwly8nqN/d9GVlLC/fvGrlOitsZUHBZkoXr6HYmx971d1xHshG4TjORvj8UIKiA3vgnY+b/8UX0jvOzXwK4nIoQcHJgVSNN/V0nLxvv5blUu3uLmQvXcjtyXOvcS+yRQ4xSDoUDFa986frMNAuc1lTls/gA+KTmYHoiwiOR975fxr/VvnidM+b6tA1GHCqny3xzfkZ1YGzJVdt6polWkOW5ciCgnwObV6bYsNuCVFEf0KXcZvX2GdErdMn+vXpYEKWcaQmjhLlh4pIi7WjWJ6JFZBYZIj3uOu6dpxoQmKCYbZqpgZHpCtNnCSRguHtZ6+QxYB2btwJV9q5MfsKDx5BjxganqhwQ79S+IbtJ5AJen1PVEU8xs/IQyB+wYQRUTT+zCBKYad39ds9waOhkbMzvIm3wxokhJGUgo6xIcwidroTf+7Fmz//8CnsJxiSFEsqE3oBrwQEb3a3nEAawBzmcUK+5hjFhOKE22683z/Td78qC1Q95pHnfwWTi1fqtjLIAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Withdraw Record</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('checkin.history')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQPSURBVHgB7ZhPbNtUGMC/z34JK+FPIrUu2bJhc4WgrOHQ3jq1Et1l7S4cWSoBJyQ6JDSJP4feuKCBuI2ipgdA4tIOLkMaUrgNaYVeuC7ehFa1IGoE2Ubq+OM9p27c1q/1a+NomvaTEj/H79m/vH9+7wN4yEFIiPrqfZMBM1FH0yNw0CPHfcBWLAsdlft0VfD39WaJPKxoTJsEAjMyE4HNv2vNVnPWyvfZB91TKlganhjVkKaQ8FmIQTaXy5aHylP75XmpWIRi8WUwDCOQrR4kihFipg4wz5OjkADG4CCcOzfpf7Yk7RbRxVODbAniCJZHXv0VCEvtwugQ0t8gYdAwnoeYNBoN/xPwxptvdST9R1Gl0M8WYD/B8sjZKSBa3DpdePrYg5larRbZqe+suVO6hougwI/Xr8Pc3BVfNJPJwNyX8/4xwHO9MyfzqVq4jBY+oaBZiZzlG9cqMrnVVTIZapdBkbHxcXj/g4/8tJAUwjtkmLZY36Bs+DcWPkHqXCwPT8zLHvTeh++Wjj93woQj8t33VyHzVCY8cLLpTU/88eltp3ABLlXlhwvQY3YPHPqvdbpQSK+INJMV4s19O+p3lYFxEMHAWV9bg7kvrvi/CUlKY4UnZ6SCXM7+5cY1K+ra3XWvzkecCV0iPHC++forGBsbh8yTmclAUFO5mejA3ZQTRA4cBFO8KpUFmeuWIAGK/A0TTDf1+q32s/h7XByVBAkxCwkRng/9Z+ntllIS1DxITHAPpPlzsGINkg09QizPxFGxDzIbeoR7jPnzoJJgPo82SObHroJgWzlUr0EBkbcEyVMLEgyUoSr/ekelxB8bLfj8Wwd+u9UE63gKLr2eg4GcLs3f1JuzQVq5BgtGeoWIFlTKfLzwly8nqN/d9GVlLC/fvGrlOitsZUHBZkoXr6HYmx971d1xHshG4TjORvj8UIKiA3vgnY+b/8UX0jvOzXwK4nIoQcHJgVSNN/V0nLxvv5blUu3uLmQvXcjtyXOvcS+yRQ4xSDoUDFa986frMNAuc1lTls/gA+KTmYHoiwiOR975fxr/VvnidM+b6tA1GHCqny3xzfkZ1YGzJVdt6polWkOW5ciCgnwObV6bYsNuCVFEf0KXcZvX2GdErdMn+vXpYEKWcaQmjhLlh4pIi7WjWJ6JFZBYZIj3uOu6dpxoQmKCYbZqpgZHpCtNnCSRguHtZ6+QxYB2btwJV9q5MfsKDx5BjxganqhwQ79S+IbtJ5AJen1PVEU8xs/IQyB+wYQRUTT+zCBKYad39ds9waOhkbMzvIm3wxokhJGUgo6xIcwidroTf+7Fmz//8CnsJxiSFEsqE3oBrwQEb3a3nEAawBzmcUK+5hjFhOKE22683z/Td78qC1Q95pHnfwWTi1fqtjLIAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Lucky Record</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('history')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQPSURBVHgB7ZhPbNtUGMC/z34JK+FPIrUu2bJhc4WgrOHQ3jq1Et1l7S4cWSoBJyQ6JDSJP4feuKCBuI2ipgdA4tIOLkMaUrgNaYVeuC7ehFa1IGoE2Ubq+OM9p27c1q/1a+NomvaTEj/H79m/vH9+7wN4yEFIiPrqfZMBM1FH0yNw0CPHfcBWLAsdlft0VfD39WaJPKxoTJsEAjMyE4HNv2vNVnPWyvfZB91TKlganhjVkKaQ8FmIQTaXy5aHylP75XmpWIRi8WUwDCOQrR4kihFipg4wz5OjkADG4CCcOzfpf7Yk7RbRxVODbAniCJZHXv0VCEvtwugQ0t8gYdAwnoeYNBoN/xPwxptvdST9R1Gl0M8WYD/B8sjZKSBa3DpdePrYg5larRbZqe+suVO6hougwI/Xr8Pc3BVfNJPJwNyX8/4xwHO9MyfzqVq4jBY+oaBZiZzlG9cqMrnVVTIZapdBkbHxcXj/g4/8tJAUwjtkmLZY36Bs+DcWPkHqXCwPT8zLHvTeh++Wjj93woQj8t33VyHzVCY8cLLpTU/88eltp3ABLlXlhwvQY3YPHPqvdbpQSK+INJMV4s19O+p3lYFxEMHAWV9bg7kvrvi/CUlKY4UnZ6SCXM7+5cY1K+ra3XWvzkecCV0iPHC++forGBsbh8yTmclAUFO5mejA3ZQTRA4cBFO8KpUFmeuWIAGK/A0TTDf1+q32s/h7XByVBAkxCwkRng/9Z+ntllIS1DxITHAPpPlzsGINkg09QizPxFGxDzIbeoR7jPnzoJJgPo82SObHroJgWzlUr0EBkbcEyVMLEgyUoSr/ekelxB8bLfj8Wwd+u9UE63gKLr2eg4GcLs3f1JuzQVq5BgtGeoWIFlTKfLzwly8nqN/d9GVlLC/fvGrlOitsZUHBZkoXr6HYmx971d1xHshG4TjORvj8UIKiA3vgnY+b/8UX0jvOzXwK4nIoQcHJgVSNN/V0nLxvv5blUu3uLmQvXcjtyXOvcS+yRQ4xSDoUDFa986frMNAuc1lTls/gA+KTmYHoiwiOR975fxr/VvnidM+b6tA1GHCqny3xzfkZ1YGzJVdt6polWkOW5ciCgnwObV6bYsNuCVFEf0KXcZvX2GdErdMn+vXpYEKWcaQmjhLlh4pIi7WjWJ6JFZBYZIj3uOu6dpxoQmKCYbZqpgZHpCtNnCSRguHtZ6+QxYB2btwJV9q5MfsKDx5BjxganqhwQ79S+IbtJ5AJen1PVEU8xs/IQyB+wYQRUTT+zCBKYad39ds9waOhkbMzvIm3wxokhJGUgo6xIcwidroTf+7Fmz//8CnsJxiSFEsqE3oBrwQEb3a3nEAawBzmcUK+5hjFhOKE22683z/Td78qC1Q95pHnfwWTi1fqtjLIAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">All Records</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('user.change.password')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAARjSURBVHgB7ZjPTxtHFMffjDcE/0CxpSYSVdqu1UsjFWFjKhGpUkxPpGkE/AVAFfVWBdRTFamAlGOlkGNv7qW5VEqrVoqrSsVFlXAEJe6h13ihUANJhQ92IbC7r2/WXrNe/GN3saha5XPx7OyO57tv5/2YAXjJ/xwGLoklk2G+759kDPvdjEOAn3WATC6bVtyMcyUw9s77Mc5xkcSFwQMkUvFp2vjKyo85p2McC4wNjcgc2RNTHE227nQsQ3YBzJdCLGqMxZ1aUgKH0JvMmeI4wNRKNp0CFwxcvT7NEO8BY2EfwCx1TTkZx8EhZL3RajPlVpxgbfnRAr3lt8YF4pjTcY4FgodPawcRKmuPrOh0jHOB/xItnYQcI0nrZYKslqQHZejozJhDZDld0+7nWnh1Q4FGrHvhn6VFPQ1nACIurD3+YabRvYYCE0Mji/STrIxmRWT4G7Uy0IZ4PN5/5a0rjhxgaWkpt7W1GbN0ZX7NpoehncCBoZFZEVKMm/QZJGTj2TYxK5/H8LmAtsA4mwAXbKxvZO7enY9tb2+bDji/lk3PNRUogjGtuXz1UunpPohnMpliq0n+KBwlucQfUtNTdimVSsU7dz4N558+rQRx/4tozjJnnRdz87NWlE+1E7f5XJ0gcYtexQlCoVD41q2PqpMyyvPnJ22aLDBWWRP0JqvZdAZasLGjjlEKS0EH6Ovrg2AwWJXA+psKJK+trAXGWlquUEBZYvwedBBToB3HudiKxjXKy0y29il/HsF3v5Qh5OfwwbtBuBjxgRfCkUjdcnGdSYT17N76bE+Dz774i+LEPnxPIj+5/9zo80JiIDG2uXkY8yxQWM/e99Pq31A+wNp1eV+Hx78fgFewi02abdcCOePX7H1B/8l4H+x2XawfzwF89LjtgvwehimryPb+4UQA5N7j5Sy/eg6GBwPgGQZyvrAvuxYoqWqsUX+QHGPq5oXa9Yc3e+C0SCDJ4teVQHRRx50W9FW+lCuBXIczEwjIjVjs0oKowBnBdHQvUFIlpdm9kMWTL0Y8xf861G7JKGJd/VNvL1O2nmliT/KG/Z7w3M9vv2LEwEses0gNBko0wtxbUICof9PsXpREvv3meegAGbNRJ9AsEsT+Q5T9jcdiCjpMuVyG3d1doy2KhkPf4Tw0EsgRa9bhB90N9yOXL3XRZge/hA6SXV6utUOhYCoa8Svm9Yl8RPsRUVHLrY4oREbpUnXx3KnDzs7ODkzf/tiwIqF8/ejhsFXgiTXIzCMJcUSB+IT2KJP2zy0WsA76OJwCIejBg6+s4kRsmbGKq+o5yeDQyBxWzk9qiJMp+3M9VK4HAgFPVjTXnEXI/Kptw1Ttb0zi6vUxEIc9nd6w26A9SbFcKo0322K0rYkMoaAnycVbWipMJBKDo+AQ4a2XX38t9d6NGzNmzPMk0A2FPZS1I22Oc36NPF1u8ti6TrGUUbgSEaHdf3ZUoBXh6aI8ExWQKDJEHldVVYn21jvBf55/ALehnOOxQgC/AAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Login Password</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db" onclick="window.location.href='{{route('service')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,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">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Help Center</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db"
                                onclick="window.location.href='{{route('clear.cached')}}'">
                                <div data-v-a2a35538="" class="icos"><img data-v-a2a35538=""
                                                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAATTSURBVHgB7ZhfSFtXHMd/595bk86JkRaLa4pXZp/WtKlamkL/pLCBjkH1bTqYCmWwpyrsoeBY9WXzaS6Pe9otg0KfzMrGLKtrxpimYGqGDgbr6nWGiVFnWvwTk5t79jv3JmkSY/TexPSlH9Dz53fvOd/z73d+NwCveMXLhUAJcLrdNm7rcA8h9AwrU0p+Vwn1Bv1jMhRJ0QKbLrSNEEr78tkowOBj/9gQFAEPRZAljpIIDvcuqprH1Io1Nhy9+w17o7gYevIdmMT0DDa5Wnvw5W/0VqinyrI96PP5Iil7i6t1EGfwVrKTq1P+MR+YgAOTYKfdyawUmLzflymOgYIGMfGxfEqoGUwLRNzaf1XdffkI8WQ9a4JiBOoaOC6ymy1BaQSKbb+QkbkPiFpt+Wx4uuZYisvXqyaXMheB485QVfWyfAKgIW8n1mgkmLM99hTYdL6tDzf+DTSKUAZwkDImQ+iSpFzbDjeDp/MWITCM4mxQJojuktrr7I2ALumXHNsLnOfedfK8Oq0VKPHizeAR9NEVpOnSJduHnV0jFovFDQaIbm377tz59vbExAR7rzspKMslCZkvcALtYfONyIFHP3bAPlhYjLs5gRsFczPuvnlzQMTD1N9x7b16VsYrsh0y9nTWKcZbIdWJD/ZBaEXpRnEPoZjtQEDkOTLa3NQs6hpIdaY5SyAlRD9NVBtFQf5ZUtqxMQlKxEJoQdQ10GeZ9dlLTKkXV/gGOlhbs6v1YYKoHqA7/dybjY224HRgxFJhgWLZ2NiAe/e8EA6HtfLli5elx5P30/YdbibzDi0373d2QVfnB9LxWr43VZffD+qBABMpQhmoPXYMrl//CFwul1am24mzdntFkOWFfC8wh4lL7E4KlAL+sfSIQkuKRDjSDSXA89WXMD4+Do5TjrQ4TWAF6cFEC+MM38Uc4a7AAcMBd+1F3gBza9SGp0yEgwZdz9zilsiyhgQKiuKEMiGAILLUkED0k2W7nymvr5QhgZxavgAi5X8NziCVoUwQlRoXKCiCDGVCsQqaHzQksK6OyJjMw0FDQG6oIcZnkEGp6l1eS8DHw2H4/rfNLNtnX6/CJ56VrLq7P61rdfKiAgbwpTImPpqo9PPUJoRR5A+/rqdrWfmPpzGY+zeu5dM9BTa1ukezW/vuIcbHhkwLtNdWBAN/bt+Gg4KA1FBzWE4VdxWYjg3zBAx/h2IylIBUiFVZWQlJcXLm7BUUyGLDZNbdogcOJWV2ZgZm8I/hcDi0NJGg/Zmzxyj4XcyCVkj9KsAEJ2eVP97j5KovOisrotB8RB/HZtwKUyt6IN6Cda+hjTG12g6bMSvUV81C/euzWl04vJQWdwojmc+/GMbmaa+9VpByNQiFBCas1g4+Gh3VRBKS/gygWyEA/HJYf74M48EH+kgPHQXhpP6I3z8JNL6qd3DyHbRZ4elfs/DkvwdZ7TNxAwOfRlRQO07UHvLl01BQYNDnZTN2tflCG/asunFjaled+mwK+KOtQJ9Pp5+trlRs595a0cIkte5sup5ULeOfHdTlIwDxt7U6tufOY/znOH1aivFc/4kaYuyXBbMsrlExEU8Mchx3BZdM3OWxeRV9KUF3xTzCXm2WVGAmLHZk4RmLgFiQwe5xRVHkhrrsQ7AX/wPXe8b7INxFEQAAAABJRU5ErkJggg==">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Clear cache</div>
                                <div data-v-a2a35538="" class="status">
                                </div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view"></li>

                            <li data-v-a2a35538="" class="db" onclick="window.location.href='{{url('logout')}}'">
                                <div data-v-a2a35538="" class="icos">
                                    <img data-v-a2a35538=""
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAiCAYAAAA6RwvCAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAJKSURBVHgB7ZjNbtNAEMdn7Foyt1yRIkjewCkSuJzMBYVTwxPE8ATwBA1PAG/QzRMkx3LCvYAlBPgNalARV98wRNntrFuriRV/VOtsK7X/i2edSfLz7MzujhEKctyhZwKMyexBCxIA0+/hEavzw9XBrjs8oBsTaFsoom9fPg4qXXKDItGjSJxkA4GJQPGTrARU/h/gIVxEliLzjiIzKfPdyQ0DwM9tC8UgDI9iUJTjjTpmmv6QMCjEPlRE29h0sw0IqSiYy4geS1sgdqp8Dbghun0glCOVib8DW5ZFCfofIDa5OYfrBLlI/Emd39ZBVvXk9e8ZgkhsvngbsP7aVGnLkaf+qUMQIzL9f2h98vyTzrWAfGbdiJbXqbQFglOE0Vq+4WHXL4PRvo5sgpG2UrK6/p8eGMuDRs6cH4fsActh3FenclccS5jH/q+RWtXgcgLnZ5d6GYZP0zDPq8UWizcpWtl3TURPDURAQE/lNXSOV0v2L1h+fgbhiLESSMi6jC4MriialjE9wPsMj848yBdzrQvaCgTLITiHZ19ZP9ZaNZshaH0BjeWbVVgJhJS2qbEhTShBs2QtQkhpi4isGOTm4B5f9IsQUloi4uw9H4EwopDdj8t8th6R3b0XH0xhzKhVOazy2zoIHRGzTU3UdI53p/iiNoI4nteBtoSQ/VbjUzwRBTSP2ZZupvaMeuEpKDPQhihg/3yAUY3vpR65Q3lI8aBtUVNf10+vTc3Stl/SRTkSawzU+zZp6rHsA5deU4CibDtNgiBo9GrjDAch4tlxobZTAAAAAElFTkSuQmCC">
                                </div>
                                <div data-v-a2a35538="" class="flexs">Sign out</div>
                                <div data-v-a2a35538="" class="status"></div>
                                <img data-v-a2a35538=""
                                     src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAADMSURBVHgB7dTNDYIwFAdwygSM4AgmwB03cAPdxDKJOIFuoOd+pKPoAm19PdC0UKQvXnmXPgj/32tS0qLYKiqlVMU57zCZMgjvtNZvQshTSnlBA8aYbuyttTQX8UBd1wMsNyxCpi+EEAMsJ/8BIRTwPhvAIkkAgywCuchPIAdZBVIInNChbduX68scAKbayXM19qsA/AtXmHgOpvdN0zw8hg3D1mm0m3/Ci0BuOAlgwjMAG44AOOsjLHdM2FUZBD7Y8KzcrcQY2xdboeoLuHmbEwiX+jgAAAAASUVORK5CYII="
                                     class="view">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div data-v-a53c4a36=""></div>


<script>
    function closeSideBar() {
        document.querySelector('.van-overlay').style.zIndex = '-1';
        document.querySelector('.van-overlay').style.opacity = '0';
        document.querySelector('.van-overlay').style.visibility = 'hidden';
        document.querySelector('#sidebar').style.left = '-100%';
    }

    function openSideBar() {
        document.querySelector('.van-overlay').style.zIndex = '2007';
        document.querySelector('.van-overlay').style.opacity = '1';
        document.querySelector('.van-overlay').style.visibility = 'visible';
        document.querySelector('#sidebar').style.left = '0%';
    }
</script>
