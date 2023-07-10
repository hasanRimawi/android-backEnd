select p.price, o.date, o.id
from medicine m, ordertable o, productorder p
where p.medicineId = m.id and m.category = 'd' and o.date >= $startingdate and o.date <=$endingdate