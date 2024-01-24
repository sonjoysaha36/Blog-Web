
              
              <div class="container" style="margin-top: 10px;">
                <div class="row my-2">
                    <div class="col-md-3">
                        <div class="card bg-primary">
                                <div class="card-body">
                                <h5 class="card-title text-light text-center fw-bolder">Subscribers</h5>
                                <p class="card-text text-light text-center fw-bold">{{$total_user}}</p>
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning ">
                                <div class="card-body">
                                <h5 class="card-title text-light text-center fw-bolder">Total Post</h5>
                                <p class="card-text text-light text-center fw-bold">{{$total_blog}}</p>
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success">
                                <div class="card-body">
                                <h5 class="card-title text-light text-center fw-bolder">Total Feedback</h5>
                                <p class="card-text text-light text-center fw-bold">{{$total_feedback}}</p>
                                
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info">
                                <div class="card-body">
                                <h5 class="card-title text-light text-center fw-bolder">Comments</h5>
                                <p class="card-text text-light text-center fw-bold">{{$total_comment}}</p>
                                </div>
                            
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="ms-3 col-md-8 mt-3">
                    
                    <canvas id="userRegistrationsChart"></canvas>
                    <script>
                      var chartData = @json($chartData);
              
                      var ctx = document.getElementById('userRegistrationsChart').getContext('2d');
                      var chart = new Chart(ctx, {
                          type: 'line',
                          data: {
                              labels: chartData.labels,
                              datasets: [{
                                  label: 'User Registrations',
                                  data: chartData.data,
                                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                  borderColor: 'rgba(75, 192, 192, 1)',
                                  borderWidth: 1
                              }]
                          },
                          options: {
                              scales: {
                                  y: {
                                      beginAtZero: true,
                                      stepSize: 1
                                  }
                              }
                          }
                      });
                  </script>
                    
                </div>
                