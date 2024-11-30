
題目一

```
Select 
    bnb_id, bnb_name, may_amount
From
    bnbs
Join
    (
        Select
            bnb_id, sum(amount) as may_amount
        From
            orders
        Where
            currrency = "TWD"
            and created_at >= "2023/05/01"
            and created_at <= "2023/05/31"
        Group by bnb_id
        Order by may_amount DESC
        Limit 10         
    )    
```

題目二

先確認索引是否有適當，先設定好索引值