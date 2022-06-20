export const getCardTemplate = (templateName, card) => {
	switch (templateName) {
		case 'player':
			const positions = card.positions.map((p) => p.short_name);
			const playerPanel = `                  
				<div>
						<a href="/players/edit/${card.id}" class="btn btn-primary mx-1">Edit</a>
						<a href="/players/delete/${card.id}" class="btn btn-danger mx-1">Remove</a>
				</div>`;

			return `
            <div class="col-md-3 my-3">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">${card.name} ${card.lastname}</h3>
                  <div class="card-text pt-3">
                    <p>
                      <strong>Positions: </strong>
                      ${positions.join(',')}
                    </p>
                    <p>
                      <strong>Nationality: </strong>
                      ${card.nationality.name}
                    </p>
                    <p>
                      <strong>Club: </strong>
                      ${card.club.name}
                    </p>
                    <p>
                        <strong>Height: </strong> ${card.height} cm
                    </p>
                    <p>
                        <strong>Weight: </strong> ${card.weight} kg
                    </p>
                  </div>
									${card.club.trainer_id == document.body.dataset.userId ? playerPanel : ''}
                </div>
              </div>
            </div>`;
		case 'club':
			const clubPanel = `
										 <a href="http://localhost:8000/clubs/edit/${card.id}" class="btn btn-primary mx-1">Edit</a>
										 <a href="http://localhost:8000/clubs/delete/${card.id}" class="btn btn-danger mx-1">Remove</a>`;
			return `
            <div class="col-md-4 my-3">
              <div class="card">
                <div class="card-body">
                    <h3 class="card-title">${card.name}</h3>
                    <div class="card-text pt-3">
                      <p>
                        <strong>League: </strong>
                        ${card.league.name}
                      </p>
                      <p>
                        <strong>Founded in: </strong>
                        ${card.foundation_date}
                      </p>
                      <p>
                        <strong>Trainer: </strong>
                        ${card.trainer.name}
                      </p>
                      <p>
                        <strong>Trainer contact: </strong>
                        <a href="mailto:${card.trainer.email}">${card.trainer.email}</a>
                      </p>
                    </div>
                    <div>
                        <a href="/players/club/${card.id}" class="btn btn-success mx-1">Show players</a>
												${card.trainer_id == document.body.dataset.userId ? clubPanel : ''}
                    </div>
                </div>
              </div>
            </div>`;
	}
};

export const validationRules = [
	{name: 'name', regex: /^([^0-9]*)$/},
	{name: 'lastname', regex: /^([^0-9]*)$/},
	{name: 'height', regex: /^\d+$/},
	{name: 'weight', regex: /^\d+$/},
	{name: 'short_name', regex: /^([^0-9]*)$/}
];
