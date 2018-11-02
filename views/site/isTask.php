<div>
	<md-table v-model="tasks" md-card md-fixed-header md-sort="date_Task">
		<md-table-toolbar>
			<div class="md-title">
				<md-button class="md-raised md-primary" @click="addTask()">
					Добавить новую задачу
				</md-button>
			</div>				
		</md-table-toolbar>
		
		<md-table-row slot="md-table-row" slot-scope="{ item }">
			<md-table-cell md-label="ID" md-sort-by="id" class="text-left">
				<div class="content-grid mdl-grid">
					{{ item.id }}
				</div>
			</md-table-cell>

			<md-table-cell md-label="задачи" class="text-left">
				<md-speed-dial md-direction="bottom">						
					{{ item.task }}					
					<md-speed-dial-content>
						<md-button class="md-primary" @click="modalEditor(item)">
							<md-icon>
								mode_edit
							</md-icon>
						</md-button>     
						<md-dialog-prompt
						:md-active.sync="activeEd"
						v-model="taskEditor"
						md-title="редактирование задачи"
						md-input-maxlength="100"
						md-input-placeholder="введите текст задачи..."
						md-cancel-text="Отмена"
						md-confirm-text="Сохранить"
						@md-cancel="onCancelEd"
						@md-confirm="onConfirmEd" />
					</md-speed-dial-content>
				</md-speed-dial>
			</md-table-cell>
			
			<md-table-cell md-label="дата создания" md-sort-by="date_Task" class="text-left">
				{{ item.date_Task }}
			</md-table-cell>
			<md-table-cell>
				<md-button class="md-primary" @click="delItem(item)">
					<md-icon>delete</md-icon>	
				</md-button>
				<md-dialog-confirm
				:md-active.sync="activeDel"
				md-title="Удаление задачи"
				md-content='<div class="text-center">Вы действительно хотите удалить<br>данную задачу?</div>'
				md-confirm-text="ДА"
				md-cancel-text="ОТМЕНИТЬ"
				@md-cancel="onCancel"
				@md-confirm="onConfirm" />
			</md-table-cell>
		</md-table-row>
	</md-table>
</div>