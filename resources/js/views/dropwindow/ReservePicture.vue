<template>
 		<div class="modal-body">
				 	<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].ReserveDate"		
					/>
					<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].Time"
					/>	
				預約丈量日 : &nbsp;&nbsp;
					<input
						type="date"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].ReserveDate"
					/><br /><br />
				預約丈量時間 :
				<input
						type="time"
						class="form-control"
						style="display: inline; width: 180px"
						v-model="Data[0].Time"
					/><br /><br />
				丈量人員 :
				 <select v-model="Data[0].MeasureMember"> 
                    <option
                      v-for="item in UserData" :value="item.EMID" :key="item"
                    >
                        {{ item.EMID }}|{{ item.EMME }}
                    </option>
                  </select><br /><br /><br />
				  丈量準備方向與重點<br />
				  <textarea class="form-control" style="height:200px;display:inline" v-model="Data[0].Memo"></textarea><br />
				  </div>
				<div style="text-align: center;height:50px;">
				  <button  @click.prevent="saveJ" data-dismiss="modal" style="display:inline;border: 1px black solid;" class="btn">確定</button>&nbsp;
				  <button data-dismiss="modal" style="display:inline;border: 1px black solid;"  class="btn">取消</button>
          		</div>
</template>>