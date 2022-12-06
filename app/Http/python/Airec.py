import joblib
import numpy as np
import sys


rules = joblib.load('C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\recommend_association.pkl')

#sys.argv[1:]
movie = sys.argv[1]
top5 = rules[rules["antecedents"].apply(lambda x:movie  in str(x))].sort_values(ascending=False,by='confidence')

top5 = top5.head(5)
top5 = top5['consequents'].apply(list).reset_index()
top5.drop(columns=['index'],inplace=True)
top5 = top5["consequents"].tolist()
#top5= np.array(top5)
topShow1 = top5[0][0]
topShow2 = top5[1][0]
topShow3 = top5[2][0]
topShow4 = top5[3][0]
topShow5 = top5[4][0]
topall = topShow1+" / "+topShow2+" / "+topShow3+" / "+topShow4+" / "+topShow5

print(topall)