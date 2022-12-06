
import sys
import joblib
import numpy as np

trans = joblib.load('C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\trans_train_mlp_text.pkl')
net = joblib.load('C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\net_train_mlp_text.pkl')


# x = comment ต้องมาในรูปแบบ array เท่านั้น
a = sys.argv[1:]
lent = len(a)
x = ""
for item  in range(lent):
     x += a[item] + " "



x = trans.transform([x])

y_pred = net.predict(x)

print(round(y_pred[0]))